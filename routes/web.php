<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Middleware\RedirectIfAuthenticatedBasedOnRole;

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware(['guest', RedirectIfAuthenticatedBasedOnRole::class])
    ->name('login');

// Route::get('/', function () {
//     return view('login');
// });
// Route::get('/home', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [LandingController::class, 'index'])->middleware(['auth', 'verified'])->name('landing');

Route::get('/destination/{itinerarySlug}', [ItineraryController::class, 'showDetail'])
    ->middleware('auth')
    ->name('itinerary.show');

Route::get('/destination/{slug1}/{slug2?}/{slug3?}', [LandingController::class, 'showByNestedCategory'])
    ->where([
        'slug1' => '[A-Za-z0-9\-]+',
        'slug2' => '[A-Za-z0-9\-]+',
        'slug3' => '[A-Za-z0-9\-]+',
    ])
    ->middleware('auth')
    ->name('itinerary.category.nested');

// Route::get('/login', [AuthenticatedSessionController::class, 'create'])
//     ->middleware(['guest', RedirectIfAuthenticatedBasedOnRole::class])
//     ->name('login');


require __DIR__.'/auth.php';
