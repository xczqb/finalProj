<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRegisterController extends Controller
{
    public function register()
    {
        return Inertia::render('Users/Register'); // Adjust path if needed
    }

    public function store(Request $request) {
        $credentials = $request->validate([
           'name' => 'required|max:255',
           'email' => 'required|lowercase|email|max:255',
           'password' => 'required|confirmed|min:3',
        ]);
   
        $user = User::create($credentials);
        
        Auth::login($user);
   
        return redirect()->route('user.home');
       }
   
}
