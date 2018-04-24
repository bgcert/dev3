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
    	if ($user->role_id == 2) {
    		$user->load('company');
    	}
    	return $user;
    }

    public function setName()
    {
    	$user = \App\User::find(request()->id);
    	$user->name = request()->name;
    	$user->save();

    	return $user->name;
    }

    public function toggleType()
    {
    	$type = (request()->type) ? 2 : 1;
    	$user = \App\User::find(request()->id);
    	$user->role_id = $type;
    	$user->save();

    	return $user->role_id;
    }
}
