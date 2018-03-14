<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    public function company()
    {
    	return $this->belongsTo('App\Company');
    }
}
