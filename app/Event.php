<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Carbon\Carbon;

class Event extends Model
{
	use LogsActivity;

	protected $fillable = [
        'theme_id', 'begin_at', 'end_at', 'cover', 'position',
    ];

    public function theme()
    {
    	return $this->belongsTo('App\Theme');
    }

    public function teachers()
    {
    	return $this->belongsToMany('App\Teacher')->withTimestamps();
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
			        });
    }

    public function getCoverAttribute($value)
    {
    	//return $this->attributes['cover'] = (!empty($value)) ? $value : '/img/default_cover.png';
    	return $this->attributes['cover'] = (!empty($value)) ? $value : $this->theme->cover; // This is cool!
    }

    public function getPositionAttribute($value)
    {
    	return $this->attributes['position'] = (!empty($value)) ? $value : $this->theme->position;
    }

    public function getBeginAttribute()
    {
    	return Carbon::parse($this->begin_at)->format('d M');
    }

    public function getEndAttribute()
    {
    	return Carbon::parse($this->end_at)->format('d M, Y');
    }

    // public function getEndAtAttribute($value)
    // {
    // 	return $this->attributes['end_at'] = Carbon::parse($value)->format('D, d M Y');
    // }
}
