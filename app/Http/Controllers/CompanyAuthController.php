<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyAuthController extends Controller
{
    public function showRegisterForm()
    {
        return inertia('InternCompany/RegisterForm'); // The Vue component for registration
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the merchant exists
        $company = \App\Models\Company::where('email', $request->email)->first();

        if (!$company) {
            return back()->withErrors(['email' => 'The provided email does not match our records.']);
        }

        // Check if the account is verified by admin
        if (!$company->is_verified) {
            return back()->withErrors(['email' => 'Your account is pending verification by the admin.']);
        }

        // Attempt login
        if (Auth::guard('web')->attempt($request->only('email', 'password'), $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('company.dashboard'));
        }

        return back()->withErrors(['password' => 'The provided password is incorrect.']);
    }

    public function destroy(Request $request)
    {
        Auth::guard('merchant')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('user.home'));
    }
}
