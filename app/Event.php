<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Event extends Model
{
	use LogsActivity;
    public function theme()
    {
    	return $this->belongsTo('App\Theme');
    }

    public function orders()
    {
    	return $this->hasMany('App\Order');
    }
}
