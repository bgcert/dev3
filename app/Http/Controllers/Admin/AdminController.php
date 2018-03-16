<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class AdminController extends Controller
{
    public function activity()
    {
        return $activity = Activity::all();
    	return view('users.index', compact('activity'));
    }
}
