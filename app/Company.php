<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Company extends Model
{
	use SoftDeletes;
	use Notifiable;

	protected $dates = ['deleted_at'];
	
	protected $fillable = ['name', 'slug', 'logo', 'address', 'phone', 'email', 'description', 'event_publish', 'venue_publish',
    ];
    
    protected $appends = ['is_followed']; // This should be changed!

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function themes()
    {
    	return $this->hasMany('App\Theme');
    }

    public function teachers()
    {
        return $this->hasMany('App\Teacher');
    }

    public function events()
    {
        return $this->hasManyThrough('App\Event', 'App\Theme');
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

    public function getIsFollowedAttribute()
    {
    	return (auth()->check()) ? $this->followers->contains(\Auth::user()) : false;
    }

    public function getLogoAttribute($value)
    {
    	return $this->attributes['logo'] = (!empty($value)) ? $value : 'default_logo.png';
    }

    public function getCoverAttribute($value)
    {
    	return $this->attributes['cover'] = (!empty($value)) ? $value : 'default_cover.png';
    }

    public function getEventPublishAttribute($value)
    {
    	return (bool) $value;
    }

    public function getVenuePublishAttribute($value)
    {
    	return (bool) $value;
    }


}
