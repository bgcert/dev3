<?php

namespace App\Messanger;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    public function messages()
    {
    	return $this->hasMany('App\Messanger\Message');
    }

    public function contacts()
    {
    	return $this->hasMany('App\Messanger\Contact');
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

    public function firstContact()
    {
    	return $this->hasOne('App\Messanger\Contact')->where('user_id', '!=', \Auth::id());
    }

}
