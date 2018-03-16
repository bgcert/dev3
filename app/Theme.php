<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'company_id', 'title', 'body',
    ];

    public function company()
    {
    	return $this->belongsTo('App\Company');
    }

    public function events()
    {
    	return $this->hasMany('App\Event');
    }

    /**
     * Get all of the post's comments.
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
