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

    public function firstFiveFollowers()
    {
    	return $this->followers()->limit(5);
    }

    public function isFollowed()
    {
    	return $this->followers()->where('user_id', auth()->id());
    }

    public function getLogoAttribute($value)
    {
    	return $this->attributes['logo'] = (!empty($value)) ? $value : '/img/default_logo.png';
    }


}
