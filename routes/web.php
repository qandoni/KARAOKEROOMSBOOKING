<?php

use App\Http\Controllers\AddonsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('rooms')->name('rooms.')->middleware('auth')->group(function () {
    Route::get('/rooms', [RoomsController::class, 'index'])->name('index');
    Route::get('/create', [RoomsController::class, 'create'])->name('create');
    Route::post('/create', [RoomsController::class, 'store'])->name('store');
    Route::get('/{room}/edit', [RoomsController::class, 'edit'])->name('edit');
    Route::patch('/{room}', [RoomsController::class, 'update'])->name('update');
    Route::delete('/{room}', [RoomsController::class, 'destroy'])->name('destroy');
});

Route::prefix('bookings')->name('booking.')->middleware('auth')->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('index');
    Route::get('/create', [BookingController::class, 'create'])->name('create');
    Route::post('/create', [BookingController::class, 'store'])->name('store');
    Route::get('/{booking}/edit', [BookingController::class, 'edit'])->name('edit');
    Route::patch('/{booking}', [BookingController::class, 'update'])->name('update');
    Route::delete('/{booking}', [BookingController::class, 'destroy'])->name('destroy');
});

Route::prefix('')->middleware('auth')->group(function () {
    Route::resource('addons', AddonsController::class)->except(['show']);
});

require __DIR__.'/auth.php';
