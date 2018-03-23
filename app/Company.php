<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function themes()
    {
    	return $this->hasMany('App\Theme');
    }

    public function events()
    {
    	return $this->themes()->join('events', 'events.theme_id', '=', 'themes.id');
    }

    public function venues()
    {
    	return $this->hasMany('App\Venue');
    }

    public function followers()
    {
    	return $this->belongsToMany('App\User', 'followers')->withTimestamps();
    }


}
