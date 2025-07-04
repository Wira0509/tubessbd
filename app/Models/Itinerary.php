<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    protected $fillable = [
        'author_id',
        'itinerary_categpry_id',
        'title',
        'slug',
        'thumbnail',
        'content',
        'is_featured'
        ];

    public function author() {
        return $this->belongsTo(Author::class);
    }

    public function getFirstCategorySlug()
    {
        return $this->categories->first()?->slug ?? 'unknown';
    }

    public function ItineraryCategory() {
        return $this->belongsToMany(ItineraryCategory::class);
    }

    public function categories(){
        return $this->belongsToMany(ItineraryCategory::class, 'itinerary_itinerary_category');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'itineraries_id');
    }
}
