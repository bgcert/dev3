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
        'role_id', 'name', 'email', 'password', 'picture', 'verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    // Relations
    public function company()
    {
    	return $this->hasOne('App\Company');
    }

    public function following()
    {
    	return $this->belongsToMany('App\Company', 'followers')->withTimestamps();
    }

    // Attribute modification
    public function getPictureAttribute($value)
    {
    	return $this->attributes['picture'] = (!empty($value)) ? $value : '/img/default_user.png';
    }

}
