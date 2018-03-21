<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeCount extends Model
{
	public $timestamps = false;
	
    public function likeable()
	{
		return $this->morphTo();
	}
}
