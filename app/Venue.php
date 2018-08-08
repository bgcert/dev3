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

    protected $fillable = ['company_id', 'name', 'description', 'capacity', 'price', 'cover'];

    protected $appends = ['only_like_count', 'only_comment_count'];

    public function company()
    {
    	return $this->belongsTo('App\Company');
    }

    public function venue_images()
    {
    	return $this->hasMany('App\VenueImage');
    }
}
