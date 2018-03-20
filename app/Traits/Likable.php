<?php

namespace App\Traits;

trait Likable
{
	/**
     * Get all of the likes.
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