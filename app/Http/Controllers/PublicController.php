<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function e()
    {
    	$events = \App\Event::with('theme', 'theme.company')->get();

    	return view('events', compact('events'));
    }

    public function v()
    {
    	$venues = \App\Venue::with('company')->get();
    	return view('venues', compact('venues'));
    }

    public function c()
    {
    	$company = \App\Company::with('user')->where('slug', request()->slug)->first();

    	$themes = $this->themesBy($company);
    	$events = $this->eventsBy($company);
    	$venues = $this->venuesBy($company);
    	
    	return view('company', compact('company', 'themes', 'events', 'venues'));
    }

    public function eventsBy($company)
    {
    	$events = \DB::table('events')
            ->join('themes', 'themes.id', '=', 'events.theme_id')
            ->where('themes.company_id', $company->id)
            ->select('events.id', 'events.cover', 'events.begin_at', 'themes.title', 'themes.cover')
            ->get();

    	return $events;
    }

    public function themesBy($company)
    {
    	$themes = \DB::table('themes')
            ->where('company_id', $company->id)
            ->get();

    	return $themes;
    }

    public function venuesBy($company)
    {
    	$events = \DB::table('venues')
            ->where('company_id', $company->id)
            ->get();

    	return $events;
    }

    public function showEvent()
    {
    	$event = \App\Event::where('id', request()->id)->with('theme.company')->first();
    	return view('event', compact('event'));
    }

    public function showVenue()
    {
    	$venue = \App\venue::where('id', request()->id)->with('company')->first();
    	$images = $venue->venue_images;
    	return view('venue', compact('venue', 'images'));
    }
}
