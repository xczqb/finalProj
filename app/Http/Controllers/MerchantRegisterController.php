<?php




namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class MerchantRegisterController extends Controller
{
    /**
     * Show the Merchant Register Page.
     */
    public function index() {
        return Inertia::render('Merchants/HomePage');

    }
    public function register()
    {
        return Inertia::render('Merchants/Register');
    }

    /**
     * Store a new merchant.
     */
    

    /**
     * Handle Merchant Registration.
     */
public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'email' => 'required|email|unique:merchants,email',
            'phone' => 'required|string|max:15',
            'business_type' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'description' => 'nullable|string|max:300',
            'business_registration' => 'required|file|mimes:jpeg,png,pdf|max:5120', // 5MB max size
            'owner_id' => 'required|file|mimes:jpeg,png,pdf|max:5120', // 5MB max size
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'agree_terms' => 'accepted',
        ]);

        // Handle file uploads
        $validated['business_registration'] = $request->file('business_registration')->store('business_documents');
        $validated['owner_id'] = $request->file('owner_id')->store('owner_ids');

        // Hash the password
        $validated['password'] = Hash::make($validated['password']);
        unset($validated['password_confirmation']);


        return redirect('/merchant')->with('status', 'Registration successful. Please wait for admin approval.');

    }
}


