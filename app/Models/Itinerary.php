<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    protected $fillable = [
        'author_id',
        'news_categpry_id',
        'title',
        'slug',
        'thumbnail',
        'content'
    ];

    public function author() {
        return $this->belongsTo(Author::class);
    }

    public function ItineraryCategory() {
        return $this->belongsTo(ItineraryCategory::class);
    }

    public function banner(){
        return $this->hasOne(Banner::class);
    }
}
