<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VenueImage extends Model
{
	protected $fillable = ['filename'];

    public function venue()
    {
    	return $this->belongsTo('App\Venue');
    }
}
