<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
	use SoftDeletes;
	use LogsActivity;
	
	protected $dates = ['deleted_at'];

	protected $fillable = ['contact_person', 'contact_number', 'comment', 'invoice'];

    public function event()
    {
    	return $this->belongsTo('App\Event');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
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
