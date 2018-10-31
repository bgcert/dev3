<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\ContactPublisherRequest;
use App\Http\Requests\OrderRequest;
use App\Events\NewNotification;
use App\Notifications\NewOrder;
use Jenssegers\Date\Date;

class PublicController extends Controller
{
	public function home()
    {
    	$events = \App\Event::upcoming()->orderBy('start_date')->get();
    	$categories = \App\Category::all();
    	return view('home', compact('categories', 'events'));
    }

    // Verify account
    public function verify($token) {

    	User::where('token', $token)->firstOrFail()
    		->update(['token' => null]);

    	return redirect()->route('home');
    }

	public function themes()
    {
    	$themes = \App\Theme::with('isLiked')->get();
    	return view('themes', compact('themes'));
    }

    public function events()
    {
    	$categories = \App\Category::whereHas('themes')->get();
    	$cities = \App\City::whereHas('events')->get();

    	if (request()->slug) {
    		$events = \App\Event::upcoming()->byCategory(request()->slug)->get();
    	} else {
    		$events = \App\Event::upcoming()->get();
    	}
    	return view('events', compact('categories', 'cities', 'events'));
    }

    public function venues()
    {
    	$venues = \App\Venue::with('company', 'isLiked')->get();
    	return view('venues', compact('venues'));
    }

    public function video()
    {
    	return view('video');
    }

    public function company()
    {
		$company = \App\Company::with('user')->where('slug', request()->slug)->first();

		// Generate a unique visit
		$company->visit();

		$themes = \App\Theme::with('category')->where('company_id', $company->id)->get();
		$theme_ids = $themes->pluck('id')->toArray();
		$events = \App\Event::upcoming()->whereIn('theme_id', $theme_ids)->get();

		$events = $events->groupBy(function($item) {
			return Date::parse($item->start_date)->format('F, Y');
		});

		// dd($events);

    	return view('company', compact('company', 'themes', 'events'));
    }

    public function user()
    {
    	$user = \App\User::find(request()->id);
    	return view('user', compact('user'));
    }

    public function showTheme()
    {
    	$theme = \App\Theme::where('id', request()->id)->with('company')->first();
    	$popularThemes = \App\Theme::where('company_id', $theme->company_id)->limit(5)->get();
    	$relatedEvents = \App\Event::upcoming()->where('theme_id', $theme->id)->limit(4)->get();
    	return view('theme', compact('theme', 'popularThemes', 'relatedEvents'));
    }

    public function showEvent()
    {
    	$event = \App\Event::where('id', request()->id)->with('city', 'teachers', 'theme.company', 'theme.comments.user')->first();
    	$event->visit();
    	$popularThemes = \App\Theme::limit(5)->get();
    	$relatedEvents = \App\Event::byCategory($event->theme->category->slug)->limit(4)->get();
    	return view('event', compact('event', 'popularThemes', 'relatedEvents'));
    }

    public function showVenue()
    {
    	$venue = \App\Venue::where('id', request()->id)->with('city', 'company', 'comments.user')->first();
    	$venue->visit();
    	$images = $venue->venue_images;
    	return view('venue', compact('venue', 'images'));
    }

    public function categories() {
    	return \DB::table('categories')->get();
    }

    public function notVerified()
    {
    	// Check if this is relevant
    	return view('verify');
    }

	public function saveContactForm(ContactPublisherRequest $request)
    {
    	$company = \App\Company::find($request->company_id);
    	$contactForm = $company->contact_forms()->create($request->all());

    	// Email and push notifications missing!!!
    	// Add user notification
    	$contactForm->feedNotifications()->create(['user_id' => $company->user_id, 'data' => $request->about]);

    	return $contactForm;
    }

    public function order(OrderRequest $request)
    {
    	$event = \App\Event::find($request->event_id);
    	$company = $event->theme->company;

    	$data = [
					'event_id' => $event->id,
					'theme_title' => $event->theme->title,
					'event_start_date' => $event->start_date,
					'event_price' => $event->price,
					'contact_person' => $request->contact_person,
					'contact_number' => $request->contact_number,
					'contact_email' => $request->contact_email,
					'invoice' => $request->invoice,
				];
    	$order = $company->orders()->create($data);

    	foreach ($request->participants as $item) {
    		$order->participants()->create([
    			'name' => $item['name']
    		]);
    	}
    	
    	if (request()->invoice) {
    		$order->details()->create($request->details);
    	}

    	// Event owner
    	$event_owner = $event->theme->company->user;

    	// Notifications should be combined eventually!!!
    	// Add user notification
    	$order->feedNotifications()->create(['user_id' => $event_owner->id, 'data' => $event->theme->title]);

    	// Send email notification
    	$event_owner->notify(new NewOrder($event));

    	// Add push notification
    	broadcast(new NewNotification($event_owner->id));
    	return $order;
    }
}
