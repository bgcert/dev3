<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Likable;
use App\Traits\Commentable;
use Spatie\Activitylog\Traits\LogsActivity;


class Venue extends Model
{
	use SoftDeletes;
	use Likable;
	use Commentable;
    use LogsActivity;

    protected $dates = ['deleted_at'];

    protected $fillable = ['company_id', 'name', 'description', 'city_id', 'address', 'capacity', 'price', 'cover'];

    protected $appends = ['only_like_count', 'only_comment_count'];

    public function company()
    {
    	return $this->belongsTo('App\Company');
    }

    public function city()
    {
    	return $this->belongsTo('App\City');
    }

    public function venue_images()
    {
    	return $this->hasMany('App\VenueImage');
    }
}
