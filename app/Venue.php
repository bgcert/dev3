<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    public function company()
    {
    	return $this->belongsTo('App\Company');
    }

    public function venue_images()
    {
    	return $this->hasMany('App\VenueImage');
    }
}
