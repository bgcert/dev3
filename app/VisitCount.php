<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitCount extends Model
{
    public function visitable()
	{
		return $this->morphTo();
	}
}
