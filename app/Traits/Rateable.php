<?php

namespace App\Traits;

trait Rateable
{
    /**
     * This model has many ratings.
     *
     * @return Rating
     */
    public function ratings()
    {
        return $this->morphMany('App\Rating', 'rateable');
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }
    public function sumRating()
    {
        return $this->ratings()->sum('rating');
    }
}