<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TimeSlot;

class MentorController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'company' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'is_current' => 'nullable|boolean',
    ]);

    auth()->user()->experiences()->create($request->all());

    return back()->with('success', 'Experience added successfully.');
}
// MentorshipController.php
public function index()
    {
        // Fetch users with experience
        $mentors = User::whereHas('experiences')
    ->with(['experiences', 'timeSlots' => function ($query) {
        $query->where('is_booked', false);
    }])
    ->get();


        return view('mentorship', compact('mentors')); // Blade: mentorship/index.blade.php
    }

    public function schedule($mentorId)
{
    $mentor = User::with(['experiences', 'timeSlots' => function ($query) {
        $query->where('is_booked', false);
    }])->findOrFail($mentorId);

    return view('mentorship.schedule', compact('mentor'));
}

public function create()
{
    return view('experience');  // Blade: resources/views/experience/add.blade.php
}
public function availability()
{
    $slots = TimeSlot::where('mentor_id', auth()->id())->latest()->get();
    return view('mentoravailability', compact('slots'));
}

public function storeAvailability(Request $request)
{
    $request->validate([
        'date' => 'required|date',
        'start_time' => 'required',
    ]);

    TimeSlot::create([
        'mentor_id' => auth()->id(),
        'date' => $request->date,
        'start_time' => $request->start_time,
        'is_booked' => false,
    ]);

    return redirect()->route('mentoravailability')->with('success', 'Slot added successfully.');
}
}
