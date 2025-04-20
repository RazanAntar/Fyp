<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 

class AdminloginController extends Controller
{
    public function showLoginForm(){
        return view('auth.adminlogin');
    }
    public function login(Request $request) {
        \Log::info('Authentication attempt:', $request->all());
    
        $validator = Validator::make($request->all(), [
            'email'=> 'required|email',
            'password' => 'required'
        ]);
    
        if ($validator->passes()) {
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                \Log::info('Authentication successful');
                return redirect()->route('admin.dashboard')->with('success', 'Login successful');
            } else {
                \Log::warning('Authentication failed');
                return redirect()->route('auth.adminlogin')->with('error', 'Email or password is incorrect');
            }
        } else {
            \Log::error('Validation failed:', $validator->errors()->toArray());
            return redirect()->route('auth.adminlogin')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }
    

  

    
}
