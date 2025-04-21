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
        \Log::debug('Login request received', [
            'email' => $request->email,
            'password_present' => !empty($request->password),
        ]);
    
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if (Auth::attempt($request->only('email', 'password'))) {
            \Log::debug('Login successful for: ' . $request->email);
    
            $request->session()->regenerate();
    
            $user = Auth::user();
    
            \Log::debug('Logged in user:', [
                'email' => $user->email,
                'status' => $user->status,
                'user_type' => $user->user_type
            ]);
    
            if ($user->status !== 'active') {
                Auth::logout();
                \Log::warning('User not active: ' . $user->email);
                return back()->withErrors([
                    'account_inactive' => 'Your account is not yet activated.',
                ]);
            }
    
            return redirect()->route($user->user_type === 'alumni' ? 'alumni.dashboard' : 'dashboard');
        }
    
        \Log::warning('Login failed for: ' . $request->email);
    
        return back()->withErrors([
            'email' => 'Invalid credentials.',
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