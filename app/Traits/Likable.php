<?php

namespace App\Traits;
use \App\Like;
use \App\LikeCount;

trait Likable
{
	/**
     * Get all of the likes.
     */
    public function likes()
    {
        return $this->morphMany('App\Like', 'likable');
    }

    /**
	 * Counter is a record that stores the total likes for the
	 * morphed record
	 */
	public function likeCount()
	{
		return $this->morphOne('App\LikeCount', 'likeable');
	}

    public function like($userId=null)
	{
		if(is_null($userId)) {
			$userId = auth()->id();
		}
		
		if($userId) {
			$like = $this->likes()
				->where('user_id', '=', $userId)
				->first();
	
			if($like) return;
	
			$like = new Like();
			$like->user_id = $userId;
			$this->likes()->save($like);
		}

		$this->incrementLikeCount();
	}

	public function unlike($userId=null)
	{
		if(is_null($userId)) {
			$userId = auth()->id();
		}
		
		if($userId) {
			$like = $this->likes()
				->where('user_id', '=', $userId)
				->first();
	
			if(!$like) { return; }
	
			$like->delete();
		}
		$this->decrementLikeCount();
	}

	public function toggle($userId=null)
	{
		if(is_null($userId)) {
			$userId = auth()->id();
		}
		
		if($userId) {
			$like = $this->likes()
				->where('user_id', '=', $userId)
				->first();
	
			if($like)
			{
				$this->unlike();
				return;
			}
	
			$like = new Like();
			$like->user_id = $userId;
			$this->likes()->save($like);
		}

		$this->incrementLikeCount();
	}

	/**
	 * Has the currently logged in user already "liked" the current object
	 *
	 * @param string $userId
	 * @return boolean
	 */
	public function liked($userId=null)
	{
		if(is_null($userId)) {
			$userId = auth()->id();
		}
		
		return (bool) $this->likes()
			->where('user_id', '=', $userId)
			->count();
	}

    public function isLiked()
    {
    	return $this->morphOne('App\Like', 'likable');
    	//return $this->likes()->where('user_id', \Auth::id())->count();
    }

    private function incrementLikeCount()
	{
		$counter = $this->likeCount()->first();
		
		if($counter) {
			$counter->count++;
			$counter->save();
		} else {
			$counter = new LikeCount;
			$counter->count = 1;
			$this->likeCount()->save($counter);
		}
	}
	
	/**
	 * Private. Decrement the total like count stored in the counter
	 */
	private function decrementLikeCount()
	{
		$counter = $this->likeCount()->first();
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