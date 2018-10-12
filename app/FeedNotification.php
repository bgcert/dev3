<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedNotification extends Model
{
	protected $fillable = ['user_id', 'data'];

    public function feedNotifications()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
