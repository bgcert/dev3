<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function eventList()
    {
    	$events = \App\Event::with('theme.likeCount', 'theme.commentCount', 'theme.isLiked', 'theme.company')->get();
    	return $events;
    }

    public function relatedEventList()
    {
    	$events = \App\Event::ByCompany(request()->company_id)->get();
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

    public function getCompanyDetails()
    {
    	$company = \App\Company::with('user', 'themes', 'events', 'venues', 'followers')
    							->with('isFollowed')
    							->where('slug', request()->slug)
    							->first();
    	return $company;
    }

    public function getComments()
    {
    	//$theme = \App\Theme::with('comments.user')->where('id', request()->id)->first();
    	$theme = \App\Theme::where('id', request()->id)->first();
    	$comments = $theme->comments()->with('user')->orderBy('created_at', 'desc')->get();
    	return $comments;
    }
}