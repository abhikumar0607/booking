<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('/booking');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/booking', [App\Http\Controllers\Customer\BookingController::class, 'index']);
Route::post('/booking-store', [App\Http\Controllers\Customer\BookingController::class, 'store'])->name('booking.store');


//admin
Route::prefix('admin')->name('admin.')->middleware(['auth','admin'])->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    //bookings
    Route::get('/bookings', [App\Http\Controllers\Admin\BookingController::class, 'index']);
});
