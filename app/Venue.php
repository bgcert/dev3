<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Likable;
use App\Traits\Commentable;
use Spatie\Activitylog\Traits\LogsActivity;
class Venue extends Model
{
	use Likable;
	use Commentable;
    use LogsActivity;

    protected $fillable = ['company_id', 'name', 'description', 'capacity', 'cover'];

    public function company()
    {
    	return $this->belongsTo('App\Company');
    }

    public function venue_images()
    {
    	return $this->hasMany('App\VenueImage');
    }
}
