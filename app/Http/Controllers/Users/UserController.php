<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
    	return 'account';
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
}
