<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VenueImage extends Model
{
	use SoftDeletes;
	
	protected $dates = ['deleted_at'];

	protected $fillable = ['filename'];

    public function venue()
    {
    	return $this->belongsTo('App\Venue');
    }
}
