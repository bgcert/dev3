<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FeedNotifiable;

class ContactPublisher extends Model
{
    use SoftDeletes;
    use FeedNotifiable;

    protected $dates = ['deleted_at'];

    protected $fillable = ['about', 'subject', 'from', 'email', 'phone', 'body'];

    public function company()
    {
    	return $this->belongsTo('App\Company');
    }
}
