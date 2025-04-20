<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Chat;
use App\Models\Professional;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function chats()
{
    // Use Laravel's built-in auth check instead of manual session check
    if (!auth()->check()) {
        return redirect()->route('login')->with('fail', 'You must be logged in to access this page');
    }

    // Get the authenticated user
    $LoggedUserInfo = auth()->user();
    
    // Retrieve professionals with error handling
    try {
        $professionals = Professional::all();
        
        return view('students.chats', [
            'LoggedUserInfo' => $LoggedUserInfo,
            'professionals' => $professionals
        ]);
        
    } catch (\Exception $e) {
        return back()->with('fail', 'Error loading chat: '.$e->getMessage());
    }
}
    

}
