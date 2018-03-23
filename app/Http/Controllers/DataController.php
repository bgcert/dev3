<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function eventList()
    {
    	$events = \App\Event::with('theme.likeCount', 'theme.isLiked', 'theme.company')->get();
    	return $events;
    }

    public function getCompany()
    {
    	$company = \App\Company::with(['followers' => function($query) { return $query->limit(5); }])
				    			->where('id', request()->id)
				    			->first();
    	return $company;
    }
}
