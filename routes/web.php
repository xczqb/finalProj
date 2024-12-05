<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyAuthController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\UserAuthenticateController;

// User Routes



Route::get('/', function () {
    return Inertia::render('Users/HomePage');
});




Route::get('/home', [UserController::class, 'index'])->name('user.home');
    Route::get('/user/login', [UserAuthenticateController::class, 'login'])->name('user.login');
    Route::post('/user/login', [UserAuthenticateController::class, 'store']);
    Route::get('/user/register', [UserRegisterController::class, 'register'])->name('user.register');
    Route::post('/user/register', [UserRegisterController::class, 'store']);
    
    Route::get('/register/company', [CompanyAuthController::class, 'showRegisterForm'])->name('company.register');
    Route::post('/register/company', [CompanyAuthController::class, 'register'])->name('company.register.submit');




// Group routes for authenticated users
Route::prefix('user')->middleware('auth:web')->group(function () {
    Route::get('/settings', [UserSettingsController::class, 'index'])->name('user.settings');
    Route::post('/logout', [UserAuthenticateController::class, 'destroy'])->name('user.logout');
});




// Include other auth routes
require __DIR__ . '/auth.php';
