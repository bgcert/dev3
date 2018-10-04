<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
	protected $fillable = ['ip_address'];

    public function visitable()
    {
        return $this->morphTo();
    }
}
