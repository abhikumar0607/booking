<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// Route::get('/', function () {
//     return redirect()->to('/booking');
// });

Auth::routes();
// Single notification read

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
    Route::post('/notifications/read/{id}', function ($id) {$n = Auth::user()->unreadNotifications()->findOrFail($id); $n->markAsRead(); return back(); })->name('notifications.read');
    Route::post('/notifications/read-all', function () { Auth::user()->unreadNotifications->markAsRead(); return back(); })->name('notifications.readAll');
    //bookings
    Route::get('/bookings', [App\Http\Controllers\Admin\BookingController::class, 'index']);
    Route::post('/booking/assign-driver', [App\Http\Controllers\Admin\BookingController::class, 'assignDriver'])->name('booking.assignDriver');
    Route::get('/booking/delete/{id}', [App\Http\Controllers\Admin\BookingController::class, 'delete_booking'])->name('booking.delete');
    Route::get('/booking/edit/{id}', [App\Http\Controllers\Admin\BookingController::class, 'edit_booking'])->name('booking.edit');
    Route::post('/booking/update/{id}', [App\Http\Controllers\Admin\BookingController::class, 'update_booking'])->name('booking.update');
    //drivers
    Route::get('/add-driver', [App\Http\Controllers\Driver\DriverController::class, 'add_new_driver']);
    Route::post('/submit-driver', [App\Http\Controllers\Driver\DriverController::class, 'submit_driver'])->name('driver.submit.driver');
    Route::get('/drivers', [App\Http\Controllers\Driver\DriverController::class, 'view_drivers']);
    Route::get('/driver/edit/{id}', [App\Http\Controllers\Driver\DriverController::class, 'edit_driver'])->name('drivers.edit');
    Route::post('/driver/update/{id}', [App\Http\Controllers\Driver\DriverController::class, 'update_driver'])->name('driver.update');
    Route::get('/drivers/delete/{id}', [App\Http\Controllers\Driver\DriverController::class, 'delete_driver'])->name('drivers.delete');
    //logos
    Route::get('/all-logos', [App\Http\Controllers\Admin\LogoController::class, 'index']);
    Route::get('/add-logo', [App\Http\Controllers\Admin\LogoController::class, 'add_logo']);
    Route::post('/submit-logo', [App\Http\Controllers\Admin\LogoController::class, 'submit_logo'])->name('submit.logo');
    Route::get('/logo/delete/{id}', [App\Http\Controllers\Admin\LogoController::class, 'delete_logo'])->name('logo.delete');
    //services
    Route::get('/all-services', [App\Http\Controllers\Admin\ServiceController::class, 'index']);
    Route::get('/add-service', [App\Http\Controllers\Admin\ServiceController::class, 'add_service']);
    Route::post('/submit-service', [App\Http\Controllers\Admin\ServiceController::class, 'submit_service'])->name('submit.service');
    Route::get('/service/delete/{id}', [App\Http\Controllers\Admin\ServiceController::class, 'delete_service'])->name('service.delete');      
    //how it works
    Route::get('/all-howitworks', [App\Http\Controllers\Admin\HowItWorkController::class, 'index']);
    Route::get('/add-how-it-work', [App\Http\Controllers\Admin\HowItWorkController::class, 'create']);
    Route::post('/submit-howitwork', [App\Http\Controllers\Admin\HowItWorkController::class, 'store'])->name('submit.howitwork');
    Route::get('/how-it-work/edit/{id}', [App\Http\Controllers\Admin\HowItWorkController::class, 'edit'])->name('howitwork.edit');
    Route::post('/how-it-work/update/{id}', [App\Http\Controllers\Admin\HowItWorkController::class, 'update'])->name('howitwork.update');
    Route::get('/how-it-work/delete/{id}', [App\Http\Controllers\Admin\HowItWorkController::class, 'delete_howitwork'])->name('howitwork.delete');
    //packages
    Route::get('/all-packages', [App\Http\Controllers\Admin\PackageController::class, 'allPackages']);
    Route::get('/add-package', [App\Http\Controllers\Admin\PackageController::class, 'addPackage']);
    Route::post('/submit-package', [App\Http\Controllers\Admin\PackageController::class, 'submitPackage'])->name('submit.package');
    Route::get('/package/delete/{id}', [App\Http\Controllers\Admin\PackageController::class, 'deletePackage'])->name('package.delete');
    Route::get('/package/edit/{id}', [App\Http\Controllers\Admin\PackageController::class, 'editPackage'])->name('package.edit');
    Route::post('/package/update/{id}', [App\Http\Controllers\Admin\PackageController::class, 'updatePackage'])->name('update.package');

});

//driver
Route::prefix('driver')->name('driver.')->middleware(['auth', 'driver', \App\Http\Middleware\UpdateLastActivity::class])->group(function () {
    // Driver Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Driver\DashboardController::class, 'dashboard_driver']);
    Route::get('/assign-bookings', [App\Http\Controllers\Driver\DashboardController::class, 'assign_bookings']);
    Route::post('/bookings/{booking}/update-status', [App\Http\Controllers\Driver\DashboardController::class, 'updateStatus'])->name('bookings.updateStatus');
});
