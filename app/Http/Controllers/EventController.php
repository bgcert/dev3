<?php

namespace App\Http\Controllers;
use App\Repositories\Event\EventRepository;

use Illuminate\Http\Request;

class EventController extends Controller
{
	protected $categories;
	protected $cities;
	protected $event;

	public function __construct(EventRepository $event)
	{
		$this->event = $event;
		$this->categories = \App\Category::all();
		$this->cities = $cities = \App\City::whereHas('events')->get();
	}

    public function index()
    {   	
    	$events = $this->event->upcoming();
    	$categories = $this->categories;
    	$cities = $this->cities;
    	return view('home', compact('categories', 'cities', 'events'));
    }

    public function browse(Request $request)
    {
    	$events = $this->event->filtered($request->city, $request->slug, $request->orderby);
    	$cities = $this->cities;

    	// Get category information
    	if ($request->slug) {
    		$category = \App\Category::where('slug', $request->slug)->first();
    		return view('browse', compact('events', 'cities', 'category'));
    	}

    	$categories = $this->categories;
    	return view('browse', compact('categories', 'cities', 'events'));
    }

    public function show()
    {
    	$event = $this->event->show(request()->id);

    	// Add new visit
    	$event->visit();

    	// Not optimized via repository
    	$popularThemes = \App\Theme::with('company')->limit(5)->get();

    	// Repository optimized
    	$relatedEvents = $this->event->related($event->theme->category->id);
    	return view('event', compact('event', 'popularThemes', 'relatedEvents'));
    }
}
