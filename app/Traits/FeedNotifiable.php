<?php

namespace App\Traits;

trait FeedNotifiable
{
    /**
     * This model has many ratings.
     *
     * @return Rating
     */
    public function feedNotifications()
    {
        return $this->morphMany('App\FeedNotification', 'feed_notifiable');
    }
}