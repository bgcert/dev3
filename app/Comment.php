<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Comment extends Model
{
	protected $fillable = ['body',];

	protected $appends = ['updated_at_carbon'];

    /**
     * Get all of the owning commentable models.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function getUpdatedAtCarbonAttribute()
    {
    	return Date::parse($this->updated_at)->diffForHumans();
    }
}
