<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;

    public function events() {
    	return $this->HasMany('App\Event');
    }
}
