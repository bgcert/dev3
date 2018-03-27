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

    public function comment($body, $userId=null)
	{
		if(is_null($userId)) {
			$userId = auth()->id();
		}
		
		if($userId) {
			$comment = new \App\Comment();
			$comment->user_id = $userId;
			$comment->body = $body;
			$this->comments()->save($comment);
			return $comment;
		}
	}
}