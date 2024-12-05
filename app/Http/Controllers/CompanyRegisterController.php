<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyRegisterController extends Controller
{

    public function showRegisterForm()
    {
        return inertia('InternCompany/RegisterForm'); // Replace with your Vue component path
    }
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'email' => 'required|email|unique:company,email',
            'phone' => 'required|string|max:15',
            'company_type' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'description' => 'nullable|string|max:300',
            'company_registration' => 'required|file|mimes:jpeg,png,pdf|max:5120', // 5MB max size
            'owner_id' => 'required|file|mimes:jpeg,png,pdf|max:5120', // 5MB max size
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'agree_terms' => 'accepted',
        ]);

        // Handle file uploads
        $validated['company_registration'] = $request->file('company_registration')->store('company_documents');
        $validated['owner_id'] = $request->file('owner_id')->store('owner_ids');

        // Hash the password
        $validated['password'] = Hash::make($validated['password']);
        unset($validated['password_confirmation']);


 // Create the company using the model
    $company = Company::create($validated);
        return redirect('/home')->with('status', 'Registration successful. Please wait for admin approval.');

    }
}
