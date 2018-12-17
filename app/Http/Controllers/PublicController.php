<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\ContactPublisherRequest;
use App\Http\Requests\OrderRequest;
use App\Jobs\ProcessOrder;
use Jenssegers\Date\Date;

// Not sure
use App\Repositories\Event\EventRepository;

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

    public function venues()
    {
    	$venues = \App\Venue::with('company')->get();
    	return view('venues', compact('venues'));
    }

    public function video()
    {
    	return view('video');
    }

    public function company(EventRepository $event)
    {
		$company = \App\Company::with('user')->where('slug', request()->slug)->first();

		// Generate a unique visit
		$company->visit();

		$themes = \App\Theme::with('category')->where('company_id', $company->id)->get();
		// $theme_ids = $themes->pluck('id')->toArray();
		// $events = \App\Event::upcoming()->whereIn('theme_id', $theme_ids)->get();

		$events = $event->byCompany($company->id);

		// $events = $events->groupBy(function($item) {
		// 	return Date::parse($item->start_date)->format('F, Y');
		// });

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
    	$theme = \App\Theme::where('id', request()->id)->with('company', 'category')->first();
    	$popularThemes = \App\Theme::with('company')->where('company_id', $theme->company_id)->limit(5)->get();
    	$relatedEvents = \App\Event::with('theme.company')->where('theme_id', $theme->id)->limit(4)->get();
    	return view('theme', compact('theme', 'popularThemes', 'relatedEvents'));
    }

    // Moved to EventController
    // public function showEvent()
    // {
    // 	$event = \App\Event::where('id', request()->id)->with('city', 'teachers', 'theme.company', 'theme.category', 'theme.comments.user')->first();
    // 	$event->visit();
    // 	$popularThemes = \App\Theme::with('company')->limit(5)->get();
    // 	$relatedEvents = \App\Event::popular($event->theme->category->id)->get();
    // 	return view('event', compact('event', 'popularThemes', 'relatedEvents'));
    // }

    public function showVenue()
    {
    	$venue = \App\Venue::where('id', request()->id)->with('city', 'company', 'comments.user')->first();
    	$venue->visit();
    	$images = $venue->venue_images->pluck('filename')->toArray();
    	array_unshift($images, $venue->cover);
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

    	$owner_id = $event->theme->company->user->id;

    	// Add user feed notification on account page
    	$order->feedNotifications()->create(['user_id' => $owner_id, 'data' => $event->theme->title]);

    	// Queue job
    	ProcessOrder::dispatch($event);
    	
    	return $order;
    }
}
