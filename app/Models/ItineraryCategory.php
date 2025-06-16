<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItineraryCategory extends Model
{
    protected $fillable = [
        'title',
        'slug'
    ];

    public function parent(){
        return $this->belongsTo(ItineraryCategory::class, 'parent_id');
    }
    public function children(){
        return $this->hasMany(ItineraryCategory::class, 'parent_id')->with('children'); 
    }
    public function itineraries()
    {
        return $this->belongsToMany(Itinerary::class, 'itinerary_itinerary_category');
    }

    public function getFullSlugPathAttribute()
    {
        $slugs = [];
        $category = $this;

        // Loop ke atas sampai tidak ada parent
        while ($category) {
            array_unshift($slugs, $category->slug);
            $category = $category->parent;
        }

        return implode('/', $slugs);
    }

}
