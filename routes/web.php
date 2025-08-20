<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// Route::get('/', function () {
//     return redirect()->to('/booking');
// });

Auth::routes();
Route::get('/register', function () {  return redirect('/login');});
Route::get('test-email', [App\Http\Controllers\TestEmailController::class, 'test_email']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\FrontEndController::class, 'home']);
//Route::get('/booking', [App\Http\Controllers\Customer\BookingController::class, 'index']);
Route::post('/store-booking', [App\Http\Controllers\Customer\BookingController::class, 'store_data'])->name('store.booking');


//admin
Route::prefix('admin')->name('admin.')->middleware(['auth','admin'])->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/notifications', [App\Http\Controllers\Admin\BookingController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-as-read', [App\Http\Controllers\Admin\BookingController::class, 'markAsRead'])->name('notifications.markAsRead');
    //bookings
    Route::get('/bookings', [App\Http\Controllers\Admin\BookingController::class, 'index']);
    Route::post('/booking/assign-driver', [App\Http\Controllers\Admin\BookingController::class, 'assignDriver'])->name('booking.assignDriver');
    Route::get('/booking/delete/{id}', [App\Http\Controllers\Admin\BookingController::class, 'delete_booking'])->name('booking.delete');
    Route::get('/add-driver', [App\Http\Controllers\Driver\DriverController::class, 'add_new_driver']);
    Route::post('/submit-driver', [App\Http\Controllers\Driver\DriverController::class, 'submit_driver'])->name('driver.submit.driver');
    Route::get('/drivers', [App\Http\Controllers\Driver\DriverController::class, 'view_drivers']);
    Route::get('/drivers/delete/{id}', [App\Http\Controllers\Driver\DriverController::class, 'delete_driver'])->name('drivers.delete');

});

//driver
Route::prefix('driver')->name('driver.')->middleware(['auth', 'driver', \App\Http\Middleware\UpdateLastActivity::class])->group(function () {
    // Driver Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Driver\DashboardController::class, 'dashboard_driver']);
    Route::get('/assign-bookings', [App\Http\Controllers\Driver\DashboardController::class, 'assign_bookings']);
});
