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
