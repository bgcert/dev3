<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\NewNotification;

class UserController extends Controller
{
    public function index()
    {
    	return view('users.index');
    }

    public function order()
    {
    	$event = \App\Event::find(request()->event_id);

    	$order = new \App\Order;
    	$order->company_id = $event->theme->company_id;
    	$order->user_id = \Auth::id();
    	$order->event_id = request()->event_id;
    	$order->theme_title = $event->theme->title;
    	$order->event_start_date = $event->start_date;
    	$order->event_price = $event->price;
    	$order->contact_person = request()->contact_person;
    	$order->contact_number = request()->contact_number;
    	$order->invoice = request()->invoice;
    	$order->save();

    	foreach (request()->participants as $item) {
    		$order->participants()->create([
    			'name' => $item['name']
    		]);
    	}
    	
    	if (request()->invoice) {
    		$order->details()->create(request()->details);
    	}

    	// Event owner
    	$event_owner = $order->event->theme->company->user;
    	$event_owner->notify(new \App\Notifications\NewOrder);

    	broadcast(new NewNotification($event_owner->id));

    	return $order;
    }

    public function follow()
    {
    	$user = \Auth::user();
    	$user->following()->toggle(request()->id);
    	return 'follow button click';
    }

    public function notifications() {
    	return \Auth::user()->notifications()->take(8)->get();
    }

    public function notification_check() {
    	return \Auth::user()->unreadNotifications()->count();
    }

    public function notification_read($id) {
    	return \Auth::user()
    				->unreadNotifications()
	    			->where('id', $id)
	    			->first()
	    			->markAsRead();
    }
}
