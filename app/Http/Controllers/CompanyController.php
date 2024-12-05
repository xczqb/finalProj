<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        // Ensure the logged-in user is a company
        if (auth()->user()->user_type !== 'company') {
            return redirect()->route('dashboard')->withErrors(['message' => 'Unauthorized access!']);
        }

        // Pass company-specific data
        return inertia('Dashboard/CompanyDashboard', [
            'company' => auth()->user(),
        ]);
    }
}
