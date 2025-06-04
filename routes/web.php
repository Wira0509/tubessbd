<?php

use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[LandingController::class, 'index'])->name('landing');

Route::get('/destination/{slug}', [LandingController::class, 'showByCategory'])->name('itinerary.category');
