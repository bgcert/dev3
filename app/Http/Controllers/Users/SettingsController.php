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
    	return ($user->role_id == 2) ? $user->load('company') : $user;
    }

    public function setName()
    {
    	$user = \App\User::find(request()->id);
    	$user->name = request()->name;
    	$user->save();

    	return $user->name;
    }

    // Maybe putting part of this in user/company model should be better!
    public function toggleType()
    {
    	$type = (request()->type) ? 2 : 1;
    	$user = \App\User::find(request()->id);
    	$user->role_id = $type;
    	$user->save();

    	return $user->role_id;
    }

    // Maybe putting part of this in user/company model should be better!
	public function toggleEventPublish()
    {
    	$status = request()->status;
    	$company = \App\Company::where('user_id', request()->id)->first();
    	$company->event_publish = (int)$status;
    	$company->save();

    	return $company->event_publish;
    }

    // Maybe putting part of this in user/company model should be better!
    public function toggleVenuePublish()
    {
    	$status = request()->status;
    	$company = \App\Company::where('user_id', request()->id)->first();
    	$company->venue_publish = (int)$status;
    	$company->save();

    	return $company->venue_publish;
    }
}
