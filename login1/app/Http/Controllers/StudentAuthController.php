<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentAuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register-student');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => 'student',
            'password' => Hash::make($request->password),
            'status' => 'inactive',
        ]);

        Auth::login($user);

        return redirect('/')->with('status', 'Registration successful! Please wait for admin approval before logging in.');

    }
}
