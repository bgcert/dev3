<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    public function company()
    {
    	return $this->belongsTo('App\Company');
    }
}
