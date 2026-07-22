<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EventController;
use App\Models\Booking;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    // DASHBOARD
Route::get('/dashboard', function () {

    $bookings = Booking::all();

    $totalBookings = Booking::count();

    $totalUsers = User::count();

    return view('dashboard', compact(
        'bookings',
        'totalBookings',
        'totalUsers'
    ));

})->middleware('auth')->name('dashboard');

    // ADMIN DASHBOARD
Route::get('/admin/dashboard', function () {

    if (auth()->user()->role !== 'admin') {
        abort(403);
    }

    $bookings = Booking::with('event')->get();

    $totalBookings = Booking::count();
    $totalUsers = User::count();

    return view('admin.dashboard', compact(
        'bookings',
        'totalBookings',
        'totalUsers'
    ));

})->middleware('auth')->name('admin.dashboard');

    // BOOKING CRUD
    Route::resource('bookings', BookingController::class);

    // EVENT CRUD (ADMIN ONLY - SIMPLE CHECK INSIDE CONTROLLER OR ROUTE)
    Route::resource('events', EventController::class);

});

require __DIR__.'/auth.php';