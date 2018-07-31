<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $fillable = ['user_id', 'body'];

    public function thread()
    {
    	return $this->belongsTo('App\Messenger\Thread');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function getUpdatedAtAttribute()
    {
    	return \Carbon\Carbon::parse($this->attributes['updated_at'])->diffForHumans();
    }
}
