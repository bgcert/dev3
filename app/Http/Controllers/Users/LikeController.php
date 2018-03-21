<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    
    public function toggleVenue()
    {
    	$venue = \App\Venue::find(request()->id);
    	$venue->toggle();
    	return $venue;
    }
    public function likeVenue()
    {
    	$venue = \App\Venue::find(request()->id);
    	$venue->like();
    	return $venue;
    }
}
