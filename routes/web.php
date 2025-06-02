<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('checkout', [PaymentController::class, 'checkout']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require base_path('routes/auth.php');

// user routes
Route::middleware('auth', 'userMiddleware')->group(function () {
    Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('user/payment', [UserController::class, 'payment'])->name('payment.form');
    Route::post('user/payment', [PaymentController::class, 'checkout'])->name('payment.checkout');
   
});
 Route::post('/midtrans/callback', [PaymentController::class, 'midtransCallback']);

// admin routes
Route::middleware('auth', 'adminMiddleware')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});