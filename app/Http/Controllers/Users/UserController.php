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
    	$order = new \App\Order;
    	$order->user_id = \Auth::id();
    	$order->event_id = request()->event_id;
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
    	return \Auth::user()->notifications;
    }
}
