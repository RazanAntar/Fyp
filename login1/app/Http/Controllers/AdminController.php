<?php

namespace App\Http\Controllers;
use App\Models\Professional;
use App\Models\Job;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin; // Assuming you use the Admin model
use Illuminate\Support\Facades\Mail;
use App\Mail\ProfessionalActivated;



class AdminController extends Controller
{

    public function index()
{
   
    $students = User::where('status', 'inactive')->get();
    $professionals = Professional::where('status', 'inactive')->get();
    $jobs = Job::where('status', 'inactive')->with('professional')->get();
    $pendingJobsCount = Job::where('status', 'pending')->count();
    $inactiveProfessionals = $professionals->count(); // Count the inactive professionals
return view('admin.dashboard', compact('professionals', 'inactiveProfessionals','jobs','pendingJobsCount','students'));

}



    

public function activateProfessional($id)
{
    $professional = Professional::findOrFail($id);
    $professional->status = 'active';
    $professional->save();

    Mail::to($professional->email)->send(new ProfessionalActivated($professional));

    return redirect()->back()->with('success', 'Professional account activated.');
}


public function approveJob($id)
{
    $job = Job::findOrFail($id);
    $job->status = 'active';
    $job->save();

    return redirect()->back()->with('success', 'Job approved.');
}
public function showPendingEvents() {
    $events = Event::where('status', 'pending')->get();
    return view('admin.pending_events', compact('events'));
}

public function approveEvent($id) {
    $event = Event::findOrFail($id);
    $event->status = 'active';
    $event->save();

    return redirect()->back()->with('success', 'Event approved successfully.');
}


public function evaluateJob(Request $request)
{
    try {
        // Validate the request data
        $validated = $request->validate([
            'major' => 'required|string',
            'salary' => 'required|numeric',
            'location' => 'required|string',
            'requirements' => 'required|string',
        ]);

        // Forward the request to Flask
        $apiUrl = env('FLASK_API_URL', 'http://localhost:5000') . '/evaluate_job';

        $response = Http::post($apiUrl, $validated);

        if ($response->successful()) {
            return $response->json();
        } else {
            // Return a JSON response with an error message
            return response()->json(['error' => 'API error: ' . $response->body()], $response->status());
        }
    } catch (\Exception $e) {
        // Return a JSON response with the exception message
        return response()->json(['error' => 'API connection error: ' . $e->getMessage()], 500);
    }
}
 



}
