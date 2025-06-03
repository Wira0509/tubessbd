<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItineraryCategory extends Model
{
    protected $fillable = [
        'title',
        'slug'
    ];
}
