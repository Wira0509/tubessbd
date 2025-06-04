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

}
