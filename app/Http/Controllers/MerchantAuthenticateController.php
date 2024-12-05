<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MerchantAuthenticateController extends Controller
{
    
    public function login(Request $request)
    {
        return Inertia::render('Merchants/Login'); // Adjust path if needed
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the merchant exists
        $merchant = \App\Models\Merchant::where('email', $request->email)->first();

        if (!$merchant) {
            return back()->withErrors(['email' => 'The provided email does not match our records.']);
        }

        // Check if the account is verified by admin
        if (!$merchant->is_verified) {
            return back()->withErrors(['email' => 'Your account is pending verification by the admin.']);
        }

        // Attempt login
        if (Auth::guard('merchant')->attempt($request->only('email', 'password'), $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('merchant.dashboard'));
        }

        return back()->withErrors(['password' => 'The provided password is incorrect.']);
    }

    public function destroy(Request $request)
    {
        Auth::guard('merchant')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('merchant.home'));
    }

    


}
