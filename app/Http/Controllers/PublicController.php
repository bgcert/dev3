<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\ContactPublisherRequest;
use App\Http\Requests\OrderRequest;
use App\Events\NewNotification;
use App\Notifications\NewOrder;

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
    	$events = \App\Event::with('theme.likeCount', 'theme.company')->get();
    	return view('events', compact('events'));
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
		$company->visit();
    	return view('company', compact('company'));
    }

    public function user()
    {
    	$user = \App\User::find(request()->id);
    	return view('user', compact('user'));
    }

    public function showTheme()
    {
    	$theme = \App\Theme::where('id', request()->id)->with('company')->first();
    	return view('theme', compact('theme'));
    }

    public function showEvent()
    {
    	$event = \App\Event::where('id', request()->id)->with('city', 'teachers', 'theme.company', 'theme.comments.user')->first();
    	$event->visit();
    	return view('event', compact('event'));
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
