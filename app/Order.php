<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FeedNotifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
	use SoftDeletes;
	use FeedNotifiable;
	use LogsActivity;
	
	protected $dates = ['deleted_at'];

	protected $guarded = ['company_id'];

    public function event()
    {
    	return $this->belongsTo('App\Event');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function company()
    {
    	return $this->belongsTo('App\Company');
    }

    public function participants()
    {
    	return $this->hasMany('App\OrderParticipant');
    }

    public function details()
    {
    	return $this->hasOne('App\OrderDetail');
    }
}
