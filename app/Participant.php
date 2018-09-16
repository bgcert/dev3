<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];
	
	protected $fillable = ['user_id', 'read_message_id', 'read_at'];

    public function thread()
    {
    	return $this->belongsTo('App\Thread');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
