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

    public function venueList()
    {
    	$venues = \App\Venue::with('likeCount', 'commentCount', 'isLiked', 'company')->get();
    	return $venues;
    }

    public function relatedEventList()
    {
    	$events = \App\Event::ByCompany(request()->company_id)->get();
    	return $events;
    }

    public function getCompany()
    {
    	$company = \App\Company::with('firstFiveFollowers')
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

    public function themeComments()
    {
    	$theme = \App\Theme::where('id', request()->id)->first();
    	$comments = $theme->comments()->with('user')->orderBy('created_at', 'desc')->get();
    	return $comments;
    }

    public function venueComments()
    {
    	$venue = \App\Venue::where('id', request()->id)->first();
    	$comments = $venue->comments()->with('user')->orderBy('created_at', 'desc')->get();
    	return $comments;
    }

    // Load venue images
    public function venueImages()
    {
    	$images = \App\VenueImage::where('venue_id', request()->id)->get();
    	return $images;
    }
}