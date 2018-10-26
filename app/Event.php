<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Visitable;
// use Spatie\Activitylog\Traits\LogsActivity;
use Jenssegers\Date\Date;
use Carbon\Carbon;

class Event extends Model
{
	use SoftDeletes;
	use Visitable;
	// use LogsActivity;

	protected $dates = ['deleted_at'];

	protected $fillable = [
        'theme_id', 'city_id', 'address', 'start_date', 'end_date', 'start_at', 'end_at', 'cover', 'price', 'active'
    ];
    // protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $appends = ['start_date_carbon'];

    public function theme()
    {
    	return $this->belongsTo('App\Theme');
    }

    public function city()
    {
    	return $this->belongsTo('App\City');
    }

    public function teachers()
    {
    	return $this->belongsToMany('App\Teacher')->withTimestamps();
    }

    public function orders()
    {
    	return $this->hasMany('App\Order');
    }

    public function scopeUpcoming($query)
    {
    	return $query->where('active', 1)->whereDate('start_date', '>', Carbon::today())->whereHas('theme')->with('theme.commentCount', 'theme.company', 'visitCount');
    }

    // For related events by company
    // Usage Event::byCompany(<company_id>)->get();
    public function scopeByCompany($query, $id)
    {
        return $query
                    ->with('theme')
                    ->whereHas('theme', function ($query) use ($id)
                        {
        	               $query->where('company_id', $id);
                        }
                    );
    }

    public function scopeByCity($query, $city_id)
    {
        return $query->where('city_id', '==', $city_id);
    }

    public function scopeByCategory($query, $slug)
    {
    	$cat = \App\Category::where('slug', $slug)->first();
    	return $query->whereHas('theme', function ($q) use ($cat) {
							    $q->where('category_id', $cat->id);
						});
    }

    public function getCoverAttribute()
    {
    	if (!empty($this->cover))
    	{
    		return $this->cover;
    	} else if(!empty($this->theme->cover))
    	{
    		return $this->theme->cover;
    	}
    	return 'default_cover.png';
    }

    public function getStartDateCarbonAttribute()
    {
    	return Date::parse($this->attributes['start_date'])->format('d M, Y');
    }

    public function getEndDateCarbonAttribute()
    {
    	return Date::parse($this->attributes['end_date'])->format('d M, Y');
    }

    public function getStartAtAttribute($value)
    {
    	return Date::parse($value)->format('H:i');
    }

    public function getEndAtAttribute($value)
    {
    	return Date::parse($value)->format('H:i');
    }

    public function getStartAtCarbonAttribute()
    {
    	return Date::parse($this->start_at)->format('H:i');
    }

    public function getEndAtCarbonAttribute()
    {
    	return Date::parse($this->end_at)->format('H:i');
    }

    public function getMonthCarbonAttribute()
    {
    	return Date::parse($this->start_at)->format('F');
    }
}
