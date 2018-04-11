<?php

namespace App\Messanger;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Message extends Model
{

	protected $appends = ['user_name'];

    public function thread()
    {
    	return $this->belongsTo('App\Messanger\Thread');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function getUserNameAttribute()
    {
    	return ($this->user->id == \Auth::id()) ? 'Вие: ' : '';
    }

    public function getUpdatedAtAttribute()
    {
    	return Carbon::parse($this->attributes['updated_at'])->diffForHumans();
    }
}
