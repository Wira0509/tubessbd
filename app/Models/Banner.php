<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'itinerary_id'
    ];

    public function Itinerary(){
        return $this->belongsTo(Itinerary::class);
    }
}
