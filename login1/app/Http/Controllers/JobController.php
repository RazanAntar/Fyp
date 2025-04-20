<?php

namespace App\Http\Controllers;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class JobController extends Controller
{
    public function __construct()
    {
        // Ensures that only authenticated users can access methods in this controller
        $this->middleware('auth');
    }

    /**
     * Handle job application submissions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $jobId  The ID of the job to which the user is applying
     * @return \Illuminate\Http\Response
     *//**
     * Display the home page with search and results on the same page.
     */
    public function index(Request $request)
    {
        $query = Job::query();

        // Apply filters only if any search criteria are provided
        $query->when($request->keyword, function ($q, $keyword) {
            $q->where(function($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('company', 'like', "%{$keyword}%");
            });
        });

        $query->when($request->location, fn($q, $location) => $q->where('location', $location));
        $query->when($request->category, fn($q, $category) => $q->where('category', $category));
        $query->when($request->job_type, fn($q, $job_type) => $q->whereIn('type', $job_type));
        $query->when($request->experience_level, fn($q, $level) => $q->where('experience_level', $level));
        $query->when($request->min_salary, fn($q, $min) => $q->where('salary', '>=', $min));
        $query->when($request->max_salary, fn($q, $max) => $q->where('salary', '<=', $max));
        $query->when($request->remote_only, fn($q) => $q->where('remote', true));

        // Get filtered jobs with pagination
        $jobs = $query->latest()->paginate(10);

        return view('home', compact('jobs'));
    }
    /**
     * Dynamic search via AJAX request.
     */
    public function search(Request $request)
    {
        $filters = $request->all();

        $jobs = Job::query()
            ->when($filters['keyword'] ?? null, function ($query, $keyword) {
                $query->where('title', 'like', "%$keyword%")
                    ->orWhere('company', 'like', "%$keyword%");
            })
            ->when($filters['location'] ?? null, function ($query, $location) {
                $query->where('location', $location);
            })
            ->when($filters['category'] ?? null, function ($query, $category) {
                $query->where('category', $category);
            })
            ->when($filters['job_type'] ?? null, function ($query, $jobType) {
                $query->whereIn('type', $jobType);
            })
            ->when($filters['experience_level'] ?? null, function ($query, $experienceLevel) {
                $query->where('experience_level', $experienceLevel);
            })
            ->when($filters['min_salary'] ?? null, function ($query, $minSalary) {
                $query->where('salary', '>=', $minSalary);
            })
            ->when($filters['max_salary'] ?? null, function ($query, $maxSalary) {
                $query->where('salary', '<=', $maxSalary);
            })
            ->when($filters['date_posted'] ?? null, function ($query, $datePosted) {
                switch ($datePosted) {
                    case 'last-24-hours':
                        $query->where('created_at', '>=', now()->subDay());
                        break;
                    case 'past-week':
                        $query->where('created_at', '>=', now()->subWeek());
                        break;
                    case 'past-month':
                        $query->where('created_at', '>=', now()->subMonth());
                        break;
                }
            })
            ->when($filters['remote_only'] ?? null, function ($query) {
                $query->where('remote', true);
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('partials.job_results', compact('jobs'))->render();
    }

    public function apply($jobId)
    {
        $job = Job::findOrFail($jobId);
    
        // Assuming 'requirements' are stored as a JSON array or a comma-separated string.
        // You need to convert it to an array if it's not already one.
        $requirements = is_array($job->requirements) ? $job->requirements : explode(',', $job->requirements);
    
        // Pass the job and its requirements to the view
        return view('jobs.apply', compact('job', 'requirements'));
    }
   
    public function submitApplication(Request $request, $jobId)
    {
        // Check if a resume is uploaded
        $resumeUploaded = $request->hasFile('resume');

        // Define validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ];

        // Conditional rules based on whether a resume is uploaded
        if (!$resumeUploaded) {
            $rules['education'] = 'required|string|max:255';
            $rules['experience'] = 'required|numeric';
        }

        // Validate the form data
        $request->validate($rules);

        // Handle the file upload if there is one
        $resumePath = null;
        if ($resumeUploaded) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }

        // Create a new job application entry using mass assignment
        try {
            $application = new JobApplication([
                'job_id' => $jobId,
                'student_id' => Auth::id(), // Retrieve the ID of the authenticated user
                'name' => $request->name,
                'email' => $request->email,
                'resume_path' => $resumePath,
                'education' => $request->input('education', ''),
                'experience' => $request->input('experience', 0),
                'requirements' => $request->has('requirements') ? implode(',', $request->requirements) : null,
            ]);

            // Save the job application
            $application->save();

            // Redirect to a specific route with a success message
            return redirect()->route('job.search')->with('success', 'Application submitted successfully!');
        } catch (\Exception $e) {
            // Log the error and redirect back with an error message
            Log::error('Failed to save application: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to save application. Please try again.');
        }
    }
    public function viewResume($id)
{
    $application = JobApplication::findOrFail($id);
    
    // Get all files in the resumes directory
    $files = Storage::disk('public')->files('resumes');
    
    // Find the matching file (case-insensitive search)
    $foundFile = null;
    foreach ($files as $file) {
        if (str_contains($file, $application->resume_path)) {
            $foundFile = $file;
            break;
        }
    }

    if (!$foundFile) {
        abort(404, "Resume file not found");
    }

    return response()->file(
        storage_path('app/public/' . $foundFile),
        ['Content-Type' => Storage::mimeType($foundFile)]
    );
}

public function extractResumeData($id)
{
    $fileHandle = null; // Ensure fileHandle is scoped for the entire try block

    try {
        $application = JobApplication::findOrFail($id);
        
        // Construct the correct path (using storage_path)
        $filePath = storage_path('app/public/' . $application->resume_path);
        
        \Log::info("Looking for file at: {$filePath}");

        if (!file_exists($filePath)) {
            return response()->json([
                'success' => false,
                'message' => 'Resume file not found at: ' . $filePath,
                'available_files' => scandir(storage_path('app/public/resumes'))
            ], 404);
        }

        // Attempt to open the file
        $fileHandle = fopen($filePath, 'r');
        if (!$fileHandle) {
            throw new \Exception("Unable to open the file at: " . $filePath);
        }

        $client = new \GuzzleHttp\Client(['timeout' => 30]);
        $response = $client->post('http://localhost:5000/parse', [
            'multipart' => [
                [
                    'name' => 'resume',
                    'contents' => $fileHandle,
                    'filename' => $application->resume_path,
                    'headers' => ['Content-Type' => 'multipart/form-data']
                ]
            ]
        ]);

        return response()->json([
            'success' => true,
            'data' => json_decode($response->getBody(), true)
        ]);

    } catch (\Exception $e) {
        \Log::error("Error processing the resume data: " . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
            'path_used' => $filePath ?? null
        ], 500);
    } finally {
        // Close the file handle if it's open
        if (is_resource($fileHandle)) {
            fclose($fileHandle);
        }
    }
}
public function alerts()
{
    $now = Carbon::now();

    $jobs = Job::whereNotNull('deadline')
        ->where('deadline', '>', $now)
        ->orderBy('deadline')
        ->with('applications.student') // make sure job applications can show students
        ->get();

    $acceptedApplications = collect();

    if (Auth::check()) {
        $acceptedApplications = JobApplication::where('student_id', Auth::id())
            ->where('status', 'accepted')
            ->with('job')
            ->get();
    }

    return view('jobs.alerts', compact('jobs', 'acceptedApplications'));
}

public function respond(Request $request, $id)
{
    $request->validate([
        'response' => 'required|in:accepted,rejected',
    ]);

    $application = JobApplication::findOrFail($id);
    $application->status = $request->input('response');
    $application->save();

    return back()->with('success', 'Application has been ' . $application->status . '.');
}


}
