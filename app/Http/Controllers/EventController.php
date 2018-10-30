<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
    	$categories = \App\Category::all();
    	$cities = \App\City::whereHas('events')->get();

    	$events = \App\Event::upcoming();
    	if ($request->slug) $events->byCategory($request->slug);
    	if ($request->city) $events->where('city_id', $request->city);

    	if ($request->orderby) {
    		if ($request->orderby == 1) $order = 'start_date';
    		if ($request->orderby == 2) $order = 'price';
    		$events->orderBy($order, 'asc');
    	}

    	$events = $events->get();
    	return view('events', compact('categories', 'cities', 'events'));
    }

    
}
