<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitCount extends Model
{
	protected $fillable = ['count'];
	protected $visible = ['count'];

    public function visitable()
	{
		return $this->morphTo();
	}
}
