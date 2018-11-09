<?php

namespace App;

use App\Notifications\VerifyEmail;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
	use SoftDeletes;
    use Notifiable;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'role_id', 'firstname', 'lastname', 'email', 'password', 'token', 'picture',
    ];

    protected $appends = ['full_name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'token'
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

    public function feedNotifications()
    {
    	return $this->hasMany('App\FeedNotification');
    }

    public function following()
    {
    	return $this->belongsToMany('App\Company', 'followers')->withTimestamps();
    }

    // Get current user's messenger threads
    public function getThreadsAttribute() {
    	$user_id = \Auth::id();
    	return \App\Thread::with('first_participant.user', 'lastMessage')
    						->whereHas('participants', function ($q) use ($user_id) {
					    		$q->where('user_id', $user_id);
					    	})->orderBy('updated_at', 'desc')->get();
    }

    // Attribute modification
    public function getPictureAttribute($value)
    {
    	return $this->attributes['picture'] = (!empty($value)) ? $value : 'default_user.png';
    }

    public function getFullNameAttribute()
	{
	    return "{$this->firstname} {$this->lastname}";
	}

	public function getAbbrAttribute()
	{
		$first = $this->firstname;
		$last = $this->lastname;

	    return mb_substr($this->firstname, 0, 1) . mb_substr($this->lastname, 0, 1);
	}

}
