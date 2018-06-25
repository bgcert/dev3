<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderParticipant extends Model
{
	protected $fillable = ['name'];

    public function order()
    {
    	return $this->belongsTo('App\Order');
    }
}
