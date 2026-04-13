<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\customer\BookingController as CustomerBookingController;
use App\Http\Controllers\customer\HistoryController as CustomerHistoryController;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get("/login", [AuthController::class, 'login'])->name('login');
Route::get("/register", [AuthController::class, 'register'])->name('register');
Route::post("/login", [AuthController::class, 'postLogin'])->name('postLogin');
Route::post("/register", [AuthController::class, 'postRegister'])->name('postRegister');
Route::get("/logout", [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');

// Admin domain
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // Route::get('/protected-admin', function () {
    //     return "You are an admin";
    // });
});

// Customer domain
Route::middleware(['auth', 'isCustomer'])->group(function () {
    // Route::get('/protected-customer', function () {
    //     return "You are an customer";
    // });
    Route::get('/booking/{id}', [CustomerBookingController::class, 'index'])->name('customer.booking.index');
    Route::post('/booking', [CustomerBookingController::class, 'store'])->name('customer.booking.store');

    Route::get('/history', [CustomerHistoryController::class, 'index'])->name('customer.history.index');
});