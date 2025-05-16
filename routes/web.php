<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\EventController;

// Event routes
Route::controller(EventController::class)->group(function () {
    Route::get('/', 'index')->name('events.index');
    Route::get('/events', 'index');
});

// Reservation routes
Route::get('/reservation/{event}/reserve', [ReservationController::class, 'show'])->name('reservation.form');
Route::post('/reservation/{event}/reserve', [ReservationController::class, 'reserve'])->name('reservation.reserve');
Route::get('/reservation/{reservation}/success', [ReservationController::class, 'success'])->name('reservation.success');
