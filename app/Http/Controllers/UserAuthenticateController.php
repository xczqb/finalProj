<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Company;

class UserAuthenticateController extends Controller
{
    /**
     * Show the login form.
     */
    public function login()
    {
        return Inertia::render('Users/Login'); // Adjust path if needed
    }

    public function store(Request $request)
    {
        // Validate the login credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Attempt login for a user
        if ($user = User::where('email', $credentials['email'])->first()) {
            if (Auth::guard('web')->attempt($credentials, $request->boolean('remember'))) {
                $request->session()->regenerate();
                return redirect()->route('user.home'); // Redirect to user dashboard
            }
        }
    
     
        
    
        // If authentication fails for both
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    
    public function destroy(Request $request)
    {
        // Determine which guard is logged in
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        } elseif (Auth::guard('company')->check()) {
            Auth::guard('company')->logout();
        }

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect to the home page
        return redirect('/');
    }
}
