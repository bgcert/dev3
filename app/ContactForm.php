<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactForm extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'subject', 'from', 'email', 'phone', 'body'];

    public function company()
    {
    	return $this->belongsTo('App\Company');
    }
}
