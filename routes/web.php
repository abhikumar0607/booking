<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\Customer\BookingController::class, 'index']);
Route::post('/booking-store', [App\Http\Controllers\Customer\BookingController::class, 'store'])->name('booking.store');


//admin
Route::prefix('admin')->name('admin.')->middleware(['auth','admin'])->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
});
