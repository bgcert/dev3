<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {
    	return view('users.settings');
    }

    public function getUserData()
    {
    	$user = \App\User::find(request()->id);
    	return ($user->company) ? $user->load('company') : $user;
    }

    public function setName()
    {
    	$user = \App\User::find(request()->id);
    	$user->name = request()->name;
    	$user->save();

    	return $user->name;
    }

    // Maybe putting part of this in user/company model should be better!
    public function setPublisher()
    {
    	$user = \App\User::find(request()->id);
    	if (request()->publisher) {
    		$company = $user->company()->updateOrCreate([], request()->all());
    		if ($company->exists) {
				$user->role_id = 2;
				$user->save();
				return 'data is saved and the user is publisher now';
			}
			return 'error, data not saved';
    	}

   		$user->role_id = 1;
   		$user->save();
   		return 'user is NOT publisher now';
    }
}
