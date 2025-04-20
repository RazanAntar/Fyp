<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\Feedback;
use App\Models\EventQuestion;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a list of all events with optional filtering and pagination.
     */
    
    public function index(Request $request)
    {
        $events = Event::with('feedbacks')
            ->when($request->keyword, function ($query, $keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                      ->orWhere('description', 'like', '%' . $keyword . '%');
            })
            ->when($request->category, function ($query, $category) {
                $query->where('category', $category);
            })
            ->when($request->type, function ($query, $type) {
                $query->where('type', $type);
            })
            ->when($request->date, function ($query, $date) {
                $query->whereDate('date_time', $date);
            })
            ->latest()
            ->paginate(6);

        return view('events.index', compact('events'));
    }

    /**
     * Display the details of a single event, including user feedback and questions.
     */
    public function show($id)
    {
        $event = Event::with(['feedbacks','professionalParticipants', 'userParticipants', 'seats'])->findOrFail($id);
        $participant = $this->getCurrentParticipant();
        $hasSeat = $event->hasSeatFor($participant);
        $feedback = $event->feedbacks()->with('author')->latest()->get();

        $questions = $event->questions()->with('user')->latest()->get();
        return view('events.show', compact('event', 'feedback', 'questions','participant','hasSeat'));
    }
    public function bookSeat($id)
    {
        $event = Event::with(['userParticipants', 'professionalParticipants'])->findOrFail($id);
        $participant = $this->getCurrentParticipant();
    
        if (!$participant) {
            return redirect()->route('login');
        }
    
        // Prevent duplicate bookings
        $alreadyBooked =
            ($participant instanceof App\Models\User && $event->userParticipants->contains($participant)) ||
            ($participant instanceof App\Models\Professional && $event->professionalParticipants->contains($participant));
    
        if ($alreadyBooked) {
            return back()->with('error', 'You have already booked this event.');
        }
    
        if ($participant instanceof App\Models\User) {
            $event->userParticipants()->attach($participant->id);
        } elseif ($participant instanceof App\Models\Professional) {
            $event->professionalParticipants()->attach($participant->id);
        }
    
        return back()->with('success', 'Seat booked successfully.');
    }
    
    
    public function showSeating($id)
    {
        $event = Event::findOrFail($id);
        $participant = $this->getCurrentParticipant();
    
        // Sample seat layout: A1–A5, B1–B5
        $allSeats = collect(['A1','A2','A3','A4','A5','B1','B2','B3','B4','B5']);
    
        $reservedSeats = $event->seats->pluck('seat_number')->toArray();
    
        $seats = $allSeats->map(function ($seat) use ($reservedSeats) {
            return (object)[
                'seat_number' => $seat,
                'occupied' => in_array($seat, $reservedSeats),
            ];
        });
    
        return view('events.seating', compact('event', 'seats'));
    }
    public function reserveSeat(Request $request, $id)
{
    $request->validate([
        'seat_number' => 'required|string',
    ]);

    $event = Event::findOrFail($id);
    $participant = $this->getCurrentParticipant();

    // Check if the seat is already taken
    if ($event->seats()->where('seat_number', $request->seat_number)->exists()) {
        return back()->with('error', 'This seat is already taken.');
    }

    $event->seats()->create([
        'seat_number' => $request->seat_number,
        'occupant_id' => $participant->id,
        'occupant_type' => get_class($participant),
    ]);

    return redirect()->route('events.show', $event->id)->with('success', 'Seat reserved!');
}


    /**
     * Register the authenticated user for an event.
     */
    public function register(Request $request, Event $event)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('info', 'Please log in to register for this event.');
        }

        $existingParticipant = EventParticipant::where('event_id', $event->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingParticipant) {
            return redirect()->route('events.myEvents')->with('error', 'You are already registered for this event.');
        }

        EventParticipant::create([
            'event_id' => $event->id,
            'user_id' => auth()->id(),
            'status' => 'registered',
        ]);

        return redirect()->route('events.myEvents')
            ->with('success', 'You have successfully registered for the event.');
    }

    /**
     * Display a list of events that the user has registered for.
     */
    public function myEvents()
    {
        $events = EventParticipant::where('user_id', auth()->id())
            ->with('event')
            ->get()
            ->map(fn ($participant) => $participant->event);

        return view('events.my-events', compact('events'));
    }

    /**
     * Allow users to leave feedback for an event they attended.
     */
    public function submitFeedback(Request $request, $id)
    {
        $request->validate(['comment' => 'required|string|max:1000']);
    
        $event = Event::findOrFail($id);
        $participant = $this->getCurrentParticipant();
    
        if ($event->date_time && now()->lt($event->date_time)) {
            return back()->with('error', 'You can only submit feedback after the event date.');
        }
    
        if (Feedback::where([
            'event_id' => $event->id,
            'author_id' => $participant->id,
            'author_type' => get_class($participant),
        ])->exists()) {
            return back()->with('error', 'You already submitted feedback.');
        }
    
        Feedback::create([
            'event_id' => $event->id,
            'author_id' => $participant->id,
            'author_type' => get_class($participant),
            'comment' => $request->comment,
        ]);
    
        return back()->with('success', 'Feedback submitted.');
    }
    
    /**
     * Allow users to ask questions about an event.
     */
    public function askQuestion(Request $request, Event $event)
    {
        $request->validate([
            'question' => 'required|string|max:1000',
        ]);

        EventQuestion::create([
            'event_id' => $event->id,
            'user_id' => auth()->id(),
            'question' => $request->question,
        ]);

        return redirect()->route('events.show', $event)
            ->with('success', 'Your question has been submitted successfully.');
    }
    protected function getCurrentParticipant()
{
    if (Auth::guard('professional')->check()) {
        return Auth::guard('professional')->user();
    }
    return Auth::user(); // fallback to regular user
}

}
