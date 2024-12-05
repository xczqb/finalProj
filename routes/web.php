<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\LogoutSessionController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\MerchantRegisterController;
use App\Http\Controllers\UserAuthenticateController;
use App\Http\Controllers\MerchantDashboardController;
use App\Http\Controllers\MerchantAuthenticateController;

// User Routes


Route::get('/merchant/dashboard', function () {
    // Check if the user is authenticated as a merchant
    if (!auth('merchant')->check()) {
        // Redirect to home page if not authenticated
        return redirect('/');
    }

    // Proceed to the merchant dashboard
    return view('merchant.dashboard');
});


Route::get('/', function () {
    return Inertia::render('Users/HomePage');
});




Route::get('/home', [UserController::class, 'index'])->name('user.home');
Route::middleware(RedirectIfAuthenticated::class . ':web')->group(function () {
    Route::get('/user/login', [UserAuthenticateController::class, 'login'])->name('user.login');
    Route::post('/user/login', [UserAuthenticateController::class, 'store']);
    Route::get('/user/register', [UserRegisterController::class, 'register'])->name('user.register');
    Route::post('/user/register', [UserRegisterController::class, 'store']);
});



// Group routes for authenticated users
Route::prefix('user')->middleware('auth:web')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::post('/logout', [UserAuthenticateController::class, 'destroy'])->name('user.logout');
});


// Merchant Routes
Route::middleware(RedirectIfAuthenticated::class . ':merchant')->group(function () {
    Route::get('/merchant', [MerchantController::class, 'index'])->name('merchant.home');
    Route::get('/merchant/login', [MerchantAuthenticateController::class, 'login'])->name('merchant.login');
    Route::post('/merchant/login', [MerchantAuthenticateController::class, 'store']);
    Route::get('/merchant/register', [MerchantRegisterController::class, 'register'])->name('merchant.register');
    Route::post('/merchant/register', [MerchantRegisterController::class, 'store']);
});



Route::prefix('merchant')->middleware('auth:merchant')->group(function () {
    Route::get('/dashboard', [MerchantDashboardController::class, 'index'])->name('merchant.dashboard');
    Route::post('/logout', [MerchantAuthenticateController::class, 'destroy'])->name('merchant.logout');

});

// // Home Page Route


// Include other auth routes
require __DIR__ . '/auth.php';
