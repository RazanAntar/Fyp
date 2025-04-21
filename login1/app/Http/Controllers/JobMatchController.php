<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class JobMatchController extends Controller
{
    public function process(Request $request)
    {
        Log::info('🎯 Job match POST request received');

        $rawInput = $request->input('profile_input');
        Log::info('🔍 User input: ' . $rawInput);

        // Sanitize input
        $input = escapeshellarg($rawInput);

        // Paths
        $pythonPath = 'C:\\Users\\User\\Desktop\\Final Year Project\\Fyp\\login1\\venv\\Scripts\\python.exe';
        $scriptPath = 'C:\\Users\\User\\Desktop\\Final Year Project\\Fyp\\login1\\job_matcher.py';

        // Quote the full command
        $command = "\"$pythonPath\" \"$scriptPath\" $input 2>&1";
        Log::info("🧪 Executing command: $command");

        try {
            $output = shell_exec($command);
            Log::info('🖥️ Python script raw output: ' . $output);

            $matches = json_decode($output, true);

            if (json_last_error() !== JSON_ERROR_NONE || !is_array($matches)) {
                return back()->withErrors(['error' => '❌ Invalid response from matcher script.']);
            }

            // Filter out matches with score = 0
            $filteredMatches = array_filter($matches, fn($match) => $match['score'] > 0);

            Session::put('matches', $filteredMatches);

            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('💥 Job matching failed: ' . $e->getMessage());
            return back()->withErrors(['error' => '💥 Job matching failed: ' . $e->getMessage()]);
        }
    }
}
