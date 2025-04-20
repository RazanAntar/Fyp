<?php

namespace App\Http\Controllers;
use App\Models\TimeSlot;
use App\Models\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'mentor_id' => 'required|exists:users,id',
            'meeting_time' => 'required', // Format: YYYY-MM-DD HH:MM
        ]);
    
        if ($request->mentor_id == auth()->id()) {
            return back()->with('error', 'You cannot schedule a meeting with yourself.');
        }
    
        [$date, $time] = explode(' ', $request->meeting_time);
    
        // ❌ Check if this student already has a meeting at this time with this mentor
        $existingMeeting = Meeting::where('student_id', auth()->id())
            ->where('mentor_id', $request->mentor_id)
            ->where('meeting_date', $date)
            ->where('meeting_time', $time)
            ->first();
    
        if ($existingMeeting) {
            return back()->with('error', 'You already have a meeting scheduled at this time with this mentor.');
        }
    
        // ✅ Proceed with booking (also book the time slot here if you wish)
        // ...
    }

}
