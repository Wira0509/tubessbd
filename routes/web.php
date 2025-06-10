<?php

use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[LandingController::class, 'index'])->name('landing');

Route::get('/destination/{itinerarySlug}', [ItineraryController::class, 'showDetail'])
    ->name('itinerary.show');

Route::get('/destination/{slug1}/{slug2?}/{slug3?}', [LandingController::class, 'showByNestedCategory'])
    ->where([
        'slug1' => '[A-Za-z0-9\-]+',
        'slug2' => '[A-Za-z0-9\-]+',
        'slug3' => '[A-Za-z0-9\-]+',
    ])
    ->name('itinerary.category.nested');
