<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
	protected $fillable = [
        'phone', 'email', 'address', 'description', 'logo', 'cover', 'facebook', 'instagram', 'linkedin', 'youtube',
    ];

    public function company()
    {
    	return $this->belongsTo('App\Company');
    }
}
