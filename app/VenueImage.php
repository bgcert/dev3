<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VenueImage extends Model
{
    public function venue()
    {
    	return $this->belongsTo('App\Venue');
    }
}
