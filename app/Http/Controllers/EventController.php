<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
	protected $categories;
	protected $cities;
	protected $events;

	public function __construct()
	{
		$this->categories = \App\Category::all();
		$this->cities = $cities = \App\City::whereHas('events')->get();
		$this->events = \App\Event::upcoming();
	}

    public function index(Request $request)
    {   	
    	$events = $this->filtered($request);
    	$categories = $this->categories;
    	$cities = $this->cities;
    	return view('home', compact('categories', 'cities', 'events'));
    }

    public function browse(Request $request)
    {
    	$events = $this->filtered($request);
    	$cities = $this->cities;

    	if ($request->slug) {
    		$category = \App\Category::where('slug', $request->slug)->first();
    		return view('browse', compact('events', 'cities', 'category'));
    	}

    	$categories = $this->categories;
    	return view('browse', compact('categories', 'cities', 'events'));
    }

    public function filtered($request)
    {
    	$events = $this->events;
    	if ($request->slug) $events->byCategory($request->slug);
    	if ($request->city) $events->where('city_id', $request->city);

    	if ($request->orderby) {
    		if ($request->orderby == 1) $order = 'start_date';
    		if ($request->orderby == 2) $order = 'price';
    		$events->orderBy($order, 'asc');
    	} else {
    		$events->orderBy('start_date', 'asc');
    	}
    	return $events->get();
    }

    
}
