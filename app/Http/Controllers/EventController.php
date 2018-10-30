<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
    	// $categories = \App\Category::whereHas('themes')->get();
    	$categories = \App\Category::all();
    	$cities = \App\City::whereHas('events')->get();

    	$events = \App\Event::upcoming();
    	if ($request->slug) $events->byCategory($request->slug);
    	if ($request->city) $events->where('city_id', $request->city);

    	if ($request->orderby) {
    		dd($request->orderby);
    	}

    	// dd($events->get());

    	$events = $events->get();

    	// $cities = $events->unique('city_id');

    	// $city_ids = $events->pluck('city_id')->unique();

    	// $cities = \App\City::find($city_ids);

    	// dd($cities);

    	// dd($events->get());

    	// if (request()->slug) {
    	// 	$events = \App\Event::upcoming()->byCategory(request()->slug)->get();
    	// } else {
    	// 	$events = \App\Event::upcoming()->get();
    	// }
    	return view('events', compact('categories', 'cities', 'events'));
    }

    
}
