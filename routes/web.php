<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// Route::get('/', function () {
//     return redirect()->to('/booking');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\FrontEndController::class, 'home']);
//Route::get('/booking', [App\Http\Controllers\Customer\BookingController::class, 'index']);
Route::post('/store-booking', [App\Http\Controllers\Customer\BookingController::class, 'store_data'])->name('store.booking');


//admin
Route::prefix('admin')->name('admin.')->middleware(['auth','admin'])->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    //bookings
    Route::get('/bookings', [App\Http\Controllers\Admin\BookingController::class, 'index']);
    Route::get('/add-driver', [App\Http\Controllers\Driver\DriverController::class, 'add_new_driver']);
    Route::post('/submit-driver', [App\Http\Controllers\Driver\DriverController::class, 'submit_driver'])->name('driver.submit.driver');
    Route::get('/drivers', [App\Http\Controllers\Driver\DriverController::class, 'view_drivers']);
});
