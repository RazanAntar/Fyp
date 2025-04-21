<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AlumniAuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register-alumni');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],
        ]);
        
        

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'user_type' => 'alumni',
            'status' => 'inactive',
        ]);

        Auth::login($user);

        return redirect('/')->with('status', 'Registration successful! Please wait for admin approval before logging in.');

    }
}
