<?php

namespace App\Http\Controllers;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;

class JobMatchController extends Controller
{
 
    public function process(Request $request)
    {
        $input = $request->input('profile_input');
    
        $jobs = Job::select('id', 'title', 'company', 'major', 'requirements')->get();
    
        if ($jobs->isEmpty()) {
            return back()->with('error', 'No jobs available for matching.');
        }
    
        $csvPath = storage_path('app/public/jobs_temp.csv');
        $handle = fopen($csvPath, 'w');
        fputcsv($handle, ['id', 'title', 'company', 'major', 'requirements']);
    
        foreach ($jobs as $job) {
            fputcsv($handle, [
                $job->id,
                $job->title,
                $job->company,
                $job->major,
                $job->requirements,
            ]);
        }
        fclose($handle);
    
        $scriptPath = base_path('job_matcher.py');
        $pythonPath = 'C:\\Users\\User\\Desktop\\fyp-test\\login\\python\\venv\\Scripts\\python.exe';
    
        $escapedInput = escapeshellarg($input);
        $escapedCSV = escapeshellarg($csvPath);
        $escapedScript = escapeshellarg($scriptPath);
    
        $command = "$pythonPath $escapedScript $escapedInput $escapedCSV";
    
        try {
            $result = Process::run($command);
    
            if (!$result->successful()) {
                throw new \Exception("Script error: " . $result->errorOutput());
            }
    
            $matches = json_decode($result->output(), true);
    
            $jobIds = collect($matches)->pluck('id');
            $jobDetails = Job::whereIn('id', $jobIds)->get()->keyBy('id');
    
            $finalMatches = collect($matches)
            ->filter(fn($match) => $match['score'] > 0)
            ->map(function ($match) use ($jobDetails) {
                $job = $jobDetails[$match['id']];
                return [
                    'id' => $job->id,
                    'title' => $job->title,
                    'company' => $job->company,
                    'score' => $match['score'],
                ];
            });
        
    
            unlink($csvPath); // optional cleanup
    
            return back()->with('matches', $finalMatches);
        } catch (\Exception $e) {
            \Log::error('Job Matching Failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'Job matching failed.');
        }
    }
}
