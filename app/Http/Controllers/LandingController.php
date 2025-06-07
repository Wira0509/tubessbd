<?php

namespace App\Http\Controllers;

use App\Models\Itinerary;
use App\Models\ItineraryCategory;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(){
        $categories = ItineraryCategory::with('children')
            ->whereNull('parent_id')
            ->orderBy('title')
            ->get();
        $featureds = Itinerary::with('categories')
            ->where('is_featured', true)
            ->get();
        return view('home', compact('categories', 'featureds'));
    }
    

    public function showByCategory($slug)
    {
        $category = ItineraryCategory::where('slug', $slug)->firstOrFail();

        $itineraries = $category->itineraries()->latest()->get();

        return view('itineraries.index', compact('itineraries', 'category'));
    }
}
