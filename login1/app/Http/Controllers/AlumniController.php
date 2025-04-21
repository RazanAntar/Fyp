<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function dashboard()
{
    $user = auth()->user();

    if ($user->user_type !== 'alumni' || $user->status !== 'active') {
        abort(403, 'Unauthorized access or account not approved.');
    }

    return view('alumni.dashboard');
}

}
