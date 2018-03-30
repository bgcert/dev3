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

    public function scopeByCompany($query, $id)
    {
        return $query->with('theme')->whereHas('theme', function ($query) use ($id) {
        	$query->where('company_id', $id);
        })->limit(10);
    }
}
