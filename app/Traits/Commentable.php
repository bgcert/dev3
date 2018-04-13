<?php

namespace App\Traits;
use \App\Comment;
use \App\CommentCount;

trait Commentable
{
	/**
     * Get all of the comments.
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function commentCount()
	{
		return $this->morphOne('App\CommentCount', 'commentable');
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
			$this->incrementCommentCount();
			return $comment;
		}
	}

	private function incrementCommentCount()
	{
		$counter = $this->commentCount()->first();
		
		if($counter) {
			$counter->count++;
			$counter->save();
		} else {
			$counter = new CommentCount;
			$counter->count = 1;
			$this->commentCount()->save($counter);
		}
	}

	private function decrementCommentCount()
	{
		$counter = $this->commentCount()->first();
		if($counter) {
			$counter->count--;
			if($counter->count >= 0) { // if result is 0 it means false in php, ">0" is true 
				$counter->save();
			}
			//  else {
			// 	$counter->delete(); // commented so count to be left 0 in the LikeCount table
			// }
		}
	}
}