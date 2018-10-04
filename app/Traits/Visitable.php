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
		$this->visits()->firstOrCreate(['ip_address' => request()->ip()]);
	}
}