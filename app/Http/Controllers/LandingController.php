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
        return view('pages.landing', compact('categories', 'featureds'));
    }  

    public function showByNestedCategory($slug1, $slug2 = null, $slug3 = null)
    {
        $slugs = array_filter([$slug1, $slug2, $slug3]);

        // Ambil kategori berdasarkan slug terakhir di URL
        $category = ItineraryCategory::where('slug', end($slugs))->firstOrFail();

        // Ambil semua ID child dari kategori ini (termasuk dirinya sendiri)
        $categoryIds = collect([$category->id])
            ->merge($category->children()->pluck('id'))
            ->toArray();

        // Ambil semua itinerary yang punya kategori salah satu dari IDs di atas
        $itineraries = Itinerary::whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('itinerary_categories.id', $categoryIds);
        })->with('categories')
        ->latest()
        ->paginate(12);

        return view('itinerary.index', compact('itineraries', 'category', 'slugs'));
    }

    // public function showDetail($slug1, $slug2 = null, $slug3 = null, $itinerarySlug)
    // {
    //     $itinerary = Itinerary::with(['categories', 'author'])->where('slug', $itinerarySlug)->firstOrFail();
    //     return view('itinerary.show', compact('itinerary'));
    // }
}
