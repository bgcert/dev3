<?php

namespace App\Messanger;

use Illuminate\Database\Eloquent\Model;

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

  //   public function getNameAttribute()
  //   {
  //   	if($this->id == \Auth::id())
		// {
		// 	$this->attributes['name'] = 'Вие: ';
		// }

		// return $this->attributes['name'];
  //   	//return $this->attributes['name'] = ($this->id == \Auth::id()) ? 'Вие: ' : $this->name;
  //   }
}
