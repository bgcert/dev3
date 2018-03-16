<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
    public function index()
    {

    	return view('users.index');
    }

    public function order()
    {
    	return;
    }

    public function follow()
    {
    	$user = \Auth::user();
    	$user->following()->toggle(request()->id);
    	return back();
    }

    public function activity()
    {
    	return Activity::all()->last();
    }
}