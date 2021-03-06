<?php

namespace App\Traits;

trait Visitable
{
	public function visits()
    {
        return $this->morphMany('App\Visit', 'visitable');
    }

    public function visitCount()
	{
		return $this->morphOne('App\VisitCount', 'visitable');
	}

	public function visit()
	{
		// Adds unique visit to visits table.
		try {
			$visit = $this->visits()->create(['ip_address' => request()->ip()]);
			$this->increase();
		} catch (\Illuminate\Database\QueryException $e) {
			return 'duplicate entry error';
		}
	}

	public function increase()
	{
		$this->visitCount()->exists() ? $this->visitCount()->increment('count') : $this->visitCount()->create();
	}

	public function getVisitsAttribute()
	{
	    return $this->visitCount ? $this->visitCount->count : 0;
	}
}