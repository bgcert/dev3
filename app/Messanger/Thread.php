<?php

namespace App\Messanger;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    public function messages()
    {
    	return $this->hasMany('App\Messanger\Message');
    }

    public function participants()
    {
    	return $this->hasMany('App\Messanger\Participant');
    }

    /**
     * Returns the latest message from a thread.
     *
     * @return null|\Messenger\Message
     */
    // public function getLatestMessageAttribute()
    // {
    //     return $this->messages()->latest()->first();
    // }

    public function lastMessage()
    {
    	return $this->hasOne('App\Messanger\Message')->orderBy('created_at', 'DESC');
    }

    public function firstParticipant()
    {
    	return $this->hasOne('App\Messanger\Participant')->where('user_id', '!=', \Auth::id());
    }

}
