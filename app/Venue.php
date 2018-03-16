<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Venue extends Model
{
    use LogsActivity;

    protected $fillable = ['company_id', 'name', 'description', 'capacity'];

    public function company()
    {
    	return $this->belongsTo('App\Company');
    }

    public function venue_images()
    {
    	return $this->hasMany('App\VenueImage');
    }

    /**
     * Get all of the venue's comments.
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
