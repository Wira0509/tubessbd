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

    public function ItineraryCategory() {
        return $this->belongsToMany(ItineraryCategory::class);
    }
}
