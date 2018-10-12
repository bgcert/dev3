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

    public function getNotifications() {
    	return \Auth::user()->feedNotifications()->take(8)->get();
    }

    public function checkNotifications() {
    	return \Auth::user()->feedNotifications()->whereNull('read_at')->count();
    }

    // Need to be improved and more practicle!!!
    public function readNotification($id) {
    	$n = \Auth::user()
    				->feedNotifications()
	    			->where('id', $id)
	    			->first();
	    $n->read_at = \Carbon\Carbon::now();
	    $n->save();
	    return 'read';
    }
}
