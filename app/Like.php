<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * Get all of the owning likable models.
     */
    public function likable()
    {
        return $this->morphTo();
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}