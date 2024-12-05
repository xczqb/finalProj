<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class MerchantDashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Merchants/Dashboard', [
            'merchant' => auth()->guard('merchant')->user(),
        ]);
    }
}
