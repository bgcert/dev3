<?php

namespace App\Messanger;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Message extends Model
{
	protected $fillable = ['user_id', 'body'];
	protected $appends = ['user_name', 'sent'];

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

    public function getSentAttribute()
    {
    	return $this->user->id;
    }
}
