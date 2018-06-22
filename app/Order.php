<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
	use LogsActivity;

    public function event()
    {
    	return $this->belongsTo('App\Event');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function participants()
    {
    	return $this->hasMany('App\OrderParticipant');
    }
}
