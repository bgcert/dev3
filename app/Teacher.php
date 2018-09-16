<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];
	
    protected $fillable = ['name', 'details', 'image'];

	public function company()
    {
    	return $this->belongsTo('App\Company');
    }

    public function event()
    {
    	return $this->belongsToMany('App\Event')->withTimestamps();
    }
}
