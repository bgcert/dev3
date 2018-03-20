<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Theme extends Model
{
    use LogsActivity;
    
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

    /**
     * Get all of the post's likes.
     */
    public function likes()
    {
        return $this->morphMany('App\Like', 'likable');
    }

    public function isLiked()
    {
    	return $this->likes()->where('user_id', \Auth::id());
    }
}
