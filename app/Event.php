<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Carbon\Carbon;

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

    // For related events by company
    // Usage Event::byCompany(<company_id>)->get();
    public function scopeByCompany($query, $id)
    {
        return $query->with('theme')->whereHas('theme', function ($query) use ($id) {
        	$query->where('company_id', $id);
        })->limit(10);
    }

    public function getCoverAttribute($value)
    {
    	return $this->attributes['cover'] = (!empty($value)) ? $value : '/img/default_cover.png';
    }

    public function getBeginAtAttribute($value)
    {
    	return $this->attributes['begin_at'] = Carbon::parse($value)->format('D, d M Y');
    }

    public function getEndAtAttribute($value)
    {
    	return $this->attributes['end_at'] = Carbon::parse($value)->format('D, d M Y');
    }
}
