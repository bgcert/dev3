<?php

namespace App\Messanger;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
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
    	return ($this->user->id == \Auth::id()) ? 'You: ' : '';
    }
}
