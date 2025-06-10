<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Itinerary;
use App\Models\ItineraryCategory;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    public function showDetail($itinerarySlug)
    {
        $itinerary = Itinerary::with(['categories', 'author'])->where('slug', $itinerarySlug)->firstOrFail();
        return view('itinerary.show', compact('itinerary'));
    }

}
