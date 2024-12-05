<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class MerchantController extends Controller
{
     /**
     * Show the Merchant Home Page.
     */
    public function index()
    {
        return Inertia::render('Merchants/HomePage');
    }

   


}

