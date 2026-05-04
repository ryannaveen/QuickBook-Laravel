<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'owner') {
            return redirect()->route('owner.dashboard');
        }
        return redirect()->route('client.dashboard');
    })->name('dashboard');
});

// Auth-required routes
Route::middleware(['auth'])->group(function () {

    // Dashboards
    Route::get('/client/dashboard', function () {
        return view('dashboard.client');
    })->name('client.dashboard');

    Route::get('/owner/dashboard', function () {
        return view('dashboard.owner');
    })->middleware('role:owner')->name('owner.dashboard');

    // Services (visible to all logged-in users)
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

    // Appointments
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::patch('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');

// Owner-only: manage their own services
Route::get('/owner/services', [ServiceController::class, 'ownerIndex'])
     ->middleware('role:owner')
     ->name('owner.services');
     
});
