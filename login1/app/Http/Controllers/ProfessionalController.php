<?php
// app/Http/Controllers/ProfessionalController.php

namespace App\Http\Controllers;

use App\Models\Professional;

use App\Models\Admin;
use App\Models\Chat;
use App\Models\Job;
use App\Models\JobActivity;
use App\Models\User;
use App\Models\Skill;
use App\Events\TestNotification;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;


class ProfessionalController extends Controller
{
    public function showRegistrationForm()
    {
        return view('prof.register');
    }
    public function dashboard()
    {
        $professionalId = Auth::guard('professional')->id();
    
        $jobs = Job::with([
            'applications.student.experiences' // 🔥 Eager load student and their experiences
        ])
        ->where('professional_id', $professionalId)
        ->where('status', 'active')
        ->get();
    
        $events = Event::where('professional_id', $professionalId)
            ->where('status', 'active')
            ->get()
            ->map(function ($event) {
                $event->date = Carbon::parse($event->date);
                return $event;
            });
    
        return view('prof.dashboard', compact('jobs', 'events'));
    }
    

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:6',
    ]);

    $professional = Professional::where('email', $request->email)->first();

    if (!$professional) {
        Log::warning('Login attempt failed for email: ' . $request->email . ' - User not found.');
        return back()->with('error', 'Invalid credentials.');
    }

    if (!Hash::check($request->password, $professional->password)) {
        Log::warning('Login attempt failed for email: ' . $request->email . ' - Password mismatch.');
        return back()->with('error', 'Invalid credentials.');
    }

    if ($professional->status !== 'active') {
        Log::info('Login attempt for email: ' . $request->email . ' - Account not active.');
        return back()->with('activation_error', 'Your account is not active yet. Please check your email for activation.');
    }

    // 🔐 Perform login
    Auth::guard('professional')->login($professional);

    session(['LoggedProfessionalInfo' => $professional->id]);

    Log::info('Professional login SUCCESS for: ' . $request->email);
    Log::info('Authenticated Professional:', ['user' => Auth::guard('professional')->user()]);

    return redirect()->route('prof.dashboard')->with('status', 'Logged in successfully.');
}

   

   
public function register(Request $request)
{
    try {
        // ✅ 1. Validate input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255', // Don't use unique rule here
            'password' => 'required|string|min:10|confirmed',
            'country_code' => 'required|string',
            'phone' => 'required|string',
            'company' => 'required|string|max:255',
            'g-recaptcha-response' => 'required',
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be valid.',
            'password.min' => 'Password must be at least 10 characters.',
            'password.confirmed' => 'Passwords do not match.',
            'phone.required' => 'Phone number is required.',
            'company.required' => 'Company name is required.',
            'g-recaptcha-response.required' => 'Please complete the reCAPTCHA.'
        ]);

        // ✅ 2. Check for existing email manually
        if (Professional::where('email', $request->email)->exists()) {
            return back()->withInput()->with('error_exists', true);
        }

        // ✅ 3. Verify reCAPTCHA
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        if (!$response->json('success')) {
            return back()->withErrors([
                'g-recaptcha-response' => 'reCAPTCHA verification failed. Please try again.'
            ])->withInput();
        }

        // ✅ 4. Create new professional
        Professional::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->country_code . $request->phone,
            'company' => $request->company,
            'status' => 'inactive',
        ]);

        return redirect()->route('professional.login.form')
->with('success_message', 'Your account has been created and is pending approval.');




    } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect()->back()->withErrors($e->errors())->withInput();
    } catch (\Exception $e) {
        \Log::error('❌ Registration failed!', [
            'error_message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
            'input' => $request->all()
        ]);
        
        return back()->withErrors([
            'form' => 'Something went wrong. Please check your input and try again.'
        ])->withInput();
    }
}



    public function postJob(Request $request)
    {
        Log::info('Job submission - Auth::user():', ['user' => Auth::user()]);
        Log::info('Job submission - professional guard user:', ['user' => Auth::guard('professional')->user()]);
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1024',
            'salary' => 'nullable|numeric',
            'location' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'experience_level' => 'nullable|string|max:255',
            'remote' => 'nullable|string|max:10',
            'major' => 'nullable|string|max:255',
            'requirements' => 'nullable|string|max:1024',
            'deadline' => 'nullable|date',
        ]);
    
        try {
            // Create job with validated data only
            $job = new Job();
            $job->fill($validatedData);
            $job->professional_id = Auth::guard('professional')->id();

            // Debug before save
            \Log::info('Attempting to save job:', $job->toArray());
            
            if ($job->save()) {
                JobActivity::create([
                    'job_id' => $job->id,
                    'professional_id' => Auth::guard('professional')->id(),
                ]);
                // Notification event
                event(new TestNotification([
                    'author' => Auth::guard('professional')->user()->name,
 // Make sure you're sending author
                    'title' => $job->title,
                    'major' => $job->major,
                ]));
                
                return redirect()->back()->with('success', 'Job posted successfully.');
            } else {
                throw new \Exception('Job save operation returned false');
            }
            
        } catch (\Exception $e) {
            \Log::error('Job post failed:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all(),
                'user' => auth()->id()
            ]);
            
            return back()
                ->withInput()
                ->with('error', 'Failed to post job: ' . $e->getMessage());
        }
    }
    

    
public function showpostjob(){
    $skills = Skill::all();
    return view('prof.post_job', compact('skills'));
}
public function showCreateEventForm() {
    return view('prof.create_event');
}

public function storeEvent(Request $request)
{
    DB::enableQueryLog();

    // ✅ Validate user input
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'date_time' => 'required|date',
        'venue' => 'required|string',
        'type' => 'required|string',
        'category' => 'required|string',
        'is_paid' => 'required|boolean',
        'price' => 'nullable|numeric',
        'max_participants' => 'nullable|integer',
    ]);

    try {
        // ✅ Normalize datetime to avoid format mismatches
        $eventDateTime = Carbon::parse($validated['date_time'])->format('Y-m-d H:i:00');

        // ✅ Check for venue + datetime conflict
        $conflict = Event::where('venue', $validated['venue'])
            ->where('date_time', $eventDateTime)
            ->exists();

        if ($conflict) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['date_time' => 'Another event is already scheduled at this venue at the selected time.']);
        }

        // ✅ Create the event using authenticated professional
        $event = new Event([
            'professional_id' => Auth::guard('professional')->id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'date_time' => $eventDateTime,
            'venue' => $validated['venue'],
            'type' => $validated['type'],
            'category' => $validated['category'],
            'is_paid' => $validated['is_paid'],
            'price' => $validated['price'],
            'max_participants' => $validated['max_participants'],
            'status' => 'pending',
        ]);

        if ($event->save()) {
            Log::info('Event saved successfully', ['id' => $event->id]);
            return redirect()->back()->with('success', 'Event created successfully.');
        } else {
            Log::error('Failed to save the event');
            return redirect()->back()->withErrors(['general' => 'Failed to save the event.']);
        }

    } catch (\Illuminate\Database\QueryException $qe) {
        Log::error('Database query error: ' . $qe->getMessage());
        return redirect()->back()->withErrors(['general' => 'Database error occurred.']);
    } catch (\Exception $e) {
        Log::error('General error: ' . $e->getMessage());
        return redirect()->back()->withErrors(['general' => 'An unexpected error occurred.']);
    }
}


    
public function evaluateJob(Request $request)
{
    $response = Http::post('http://localhost:5000/evaluate_job', [
        'major' => $request->major,
        'salary' => $request->salary,
        'location' => $request->location,
        'requirements' => $request->requirements,
    ]);

    return $response->json();
}
public function chats()
{
    $professional = Auth::guard('professional')->user();
    
    if (!$professional) {
        return redirect()->route('prof.login')
               ->with('error', 'Session expired. Please login again.');
    }
    $users = User::all();
    $chats = Chat::where(function($query) use ($professional) {
            $query->where('sender_id', $professional->id)
                  ->orWhere('receiver_id', $professional->id);
        })
        ->with(['senderProfilee', 'receiverProfilee'])
        ->get();

    return view('prof.chats', compact('chats', 'professional', 'users'));
}
    
     
public function showlogin(){
    return view('prof.login'); 
}
}
