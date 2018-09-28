<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class City extends Model
{
    public $timestamps = false;

    public function events() {
    	return $this->hasMany('App\Event');
    }

    public function venues() {
    	return $this->hasMany('App\Venue');
    }

    public function event() {
    	return $this->hasMany('App\Event');
    }
}
