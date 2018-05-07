<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['name', 'details', 'image'];

	public function company()
    {
    	return $this->belongsTo('App\Company');
    }

    public function event()
    {
    	return $this->belongsToMany('App\Event')->withTimestamps();
    }
}
