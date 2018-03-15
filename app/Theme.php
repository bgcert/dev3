<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    public function company()
    {
    	return $this->belongsTo('App\Company');
    }

    public function events()
    {
    	return $this->hasMany('App\Event');
    }
}
