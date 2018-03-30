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

    public function relatedEventList()
    {
    	//$events = \App\Event::with('theme.likeCount', 'theme.isLiked', 'theme.company')->where('theme.company_id', request()->company_id)->get();
    	$events = \App\Event::ByCompany(request()->company_id)->get();
    	//dd($events);
    	return $events;
    }

    public function getCompany()
    {
    	$company = \App\Company::with('firstFiveFollowers')
    							->with('isFollowed')
				    			->where('id', request()->id)
				    			->first();
    	return $company;
    }

    public function getComments()
    {
    	$theme = \App\Theme::with('comments.user')->where('id', request()->id)->first();
    	return $theme->comments;
    }
}
