<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Dashboard');
    }
}
