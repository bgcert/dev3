<?php

namespace App\Messanger;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $fillable = ['user_id'];

    public function thread()
    {
    	return $this->belongsTo('App\Messanger\Thread');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
