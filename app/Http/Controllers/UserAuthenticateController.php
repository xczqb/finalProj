<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthenticateController extends Controller
{

    
    public function login()
    {
        return Inertia::render('Users/Login'); // Adjust path if needed
    }


    public function store(Request $request) {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))){
            $request->session()->regenerate();

            return redirect()->intended(route('user.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'

        ])->onlyInput('email');   
    }

    public function destroy(Request $request)
    {
        // Logout the user using the 'user' guard
        Auth::guard('user')->logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect to the home page
        return redirect('/');
    }
}
