<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'picture',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function company()
    {
    	return $this->hasOne('App\Company');
    }

    public function following()
    {
    	return $this->belongsToMany('App\Company', 'followers')->withTimestamps();
    }

 //    public function likes()
 //    {
 //    	return $this->hasMany('App\Like');
 //    }

	// public function comments()
 //    {
 //    	return $this->morphMany('App\Comment', 'commentable');
 //    }    

}
