<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentCount extends Model
{
    public $timestamps = false;
	
    public function commentable()
	{
		return $this->morphTo();
	}
}
