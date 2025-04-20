<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show the login form
     */
    public function create(): View|RedirectResponse
    {
        \Log::debug('Login page accessed', [
            'authenticated' => auth()->check(),
            'guard' => Auth::getDefaultDriver(),
            'user' => auth()->user() ? auth()->user()->email : null
        ]);
    
        if (Auth::guard('web')->check()) {
            \Log::debug('Redirecting to dashboard - already logged in');
            return redirect()->route('dashboard');
        }
        //\Log::info('User logged in:', ['user' => auth()->user()]);

        return view('auth.login');
    }

    /**
     * Handle login attempt
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate(); // Regenerate session for security
    
            \Log::info('Login SUCCESS');
            \Log::info('Auth user right after login:', ['user' => auth()->user()]);
    
            $user = Auth::user();
    
            // Redirect based on user_type
            if ($user->user_type === 'alumni') {
                return redirect()->route('alumni.dashboard');
            }
    
            return redirect()->route('dashboard'); // Default for students
        }
    
        \Log::warning('Login FAILED');
        
        return back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }
    

    /**
     * Logout
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}