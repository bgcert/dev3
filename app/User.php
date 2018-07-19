<?php

namespace App;

use App\Notifications\VerifyEmail;
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
        'role_id', 'firstname', 'lastname', 'email', 'password', 'token', 'picture', 'verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'verification_token'
    ];

    public function verified()
    {
    	return $this->token === null;
    }

    public function sendVerificationEmail()
    {
    	$this->notify(new VerifyEmail($this)); // <$this> is probably this instance
    }

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
