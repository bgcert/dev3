<?php

namespace App\Traits;

trait Activitiable
{
    /**
     * This model has many ratings.
     *
     * @return Rating
     */
    public function activities()
    {
        return $this->morphMany('App\Activity', 'activitiable');
    }
}