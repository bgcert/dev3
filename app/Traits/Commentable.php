<?php

namespace App\Traits;

trait Commentable
{
	/**
     * Get all of the comments.
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}