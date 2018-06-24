<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    	$order->save();

    	foreach (request()->participants as $item) {
    		$order->participants()->create([
    			'name' => $item['name']
    		]);
    	}

    	// Event owner
    	$order->event->theme->company->user->notify(new \App\Notifications\NewOrder);

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
