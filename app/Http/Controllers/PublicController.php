<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\ContactPublisherRequest;
use App\Events\NewNotification;
use App\Notifications\NewOrder;

class PublicController extends Controller
{
	public function home()
    {
    	$events = \App\Event::whereHas('theme')->with('theme.company')->get();
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
    	$venues = \App\Venue::with('company', 'isLiked')->withCount('likes')->get();
    	return view('venues', compact('venues'));
    }

    public function video()
    {
    	return view('video');
    }

    public function company()
    {
		$company = \App\Company::with('user')->where('slug', request()->slug)->first();
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
    	return view('event', compact('event'));
    }

    public function showVenue()
    {
    	$venue = \App\Venue::where('id', request()->id)->with('city', 'company', 'comments.user')->first();
    	$images = $venue->venue_images;
    	return view('venue', compact('venue', 'images'));
    }

    public function categories() {
    	return \DB::table('categories')->get();
    }

    public function notVerified()
    {
    	return view('verify');
    }

	public function saveContactForm(ContactPublisherRequest $request)
    {
    	$company = \App\Company::find($request->company_id);
    	$contactForm = $company->contact_forms()->create($request->all());
    	return $contactForm;
    }

    public function order()
    {
    	$event = \App\Event::find(request()->event_id);

    	$company = \App\Company::find($event->theme->company_id);

    	$theme_data = [
    					'event_id' => $event->id,
    					'theme_title' => $event->theme->title,
    					'event_start_date' => $event->start_date,
    					'event_price' => $event->price
    				];
    	$request = request()->all() + $theme_data;
    	// dd($request);
    	$order = $company->orders()->create($request);
    	// $order = new \App\Order;
    	// $order->company_id = $event->theme->company_id;
    	// // $order->user_id = \Auth::id();
    	// // $order->event_id = request()->event_id;
    	// $order->theme_title = $event->theme->title;
    	// $order->event_start_date = $event->start_date;
    	// $order->event_price = $event->price;
    	// $order->contact_person = request()->contact_person;
    	// $order->contact_number = request()->contact_number;
    	// $order->contact_email = request()->contact_email;
    	// $order->invoice = request()->invoice;
    	// $order->save();

    	foreach (request()->participants as $item) {
    		$order->participants()->create([
    			'name' => $item['name']
    		]);
    	}
    	
    	if (request()->invoice) {
    		$order->details()->create(request()->details);
    	}

    	// Event owner
    	$event_owner = $event->theme->company->user;
    	$event_owner->notify(new NewOrder($event));
    	// $event_owner->notify(new New($invoice));

    	broadcast(new NewNotification($event_owner->id));

    	return $order;
    }
}
