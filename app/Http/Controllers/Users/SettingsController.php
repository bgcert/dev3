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
    public function setPublisher()
    {
    	$user = \App\User::find(request()->id);
    	if (request()->publisher) {
    		$user->role_id = 2;
    		$user->save();

    		$company = \App\Company::firstOrNew(['user_id' => $user->id]);
    		$company->update(request()->all());
    		//dd($company);
    		return 'user is publisher now';
    	} else
    	{
    		$user->role_id = 1;
    		$user->save();
    		return 'user is NOT publisher now';
    	}

    	$company = \App\Company::where('user_id', request()->id)->first();
    	$company->venue_publish = (int)$status;
    	$company->save();

    	return $company->venue_publish;
    }
}
