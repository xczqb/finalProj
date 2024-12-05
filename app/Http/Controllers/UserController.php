<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Page to view

    public function index()
    {
        return Inertia::render('Users/HomePage'); // Adjust path if needed
    }

   

    // end of page view



    public function store(Request $request) {
        $credentials = $request->validate([
           'name' => 'required|max:255',
           'email' => 'required|lowercase|email|max:255',
           'password' => 'required|confirmed|min:3',
        ]);
   
        $user = User::create($credentials);
        
        Auth::login($user);
   
        return redirect()->route('home');
       }
}
