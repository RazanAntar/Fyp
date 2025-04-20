<?php

namespace App\Http\Controllers;
use App\Models\JobActivity;
use Illuminate\Http\Request;

class JobActivityController extends Controller
{
    public function index()
    {
        $activities = JobActivity::with([
            'job.applications.student', // 🔥 Eager load applicants
            'professional'
        ])
        ->orderByDesc('created_at')
        ->take(20)
        ->get();

        return view('jobs.alert', compact('activities'));
    }
}
