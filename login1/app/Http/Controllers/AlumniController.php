<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->user_type !== 'alumni') {
            abort(403, 'Unauthorized access.');
        }

        return view('alumni.dashboard');
    }
}
