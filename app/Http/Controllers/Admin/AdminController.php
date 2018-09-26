<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class AdminController extends Controller
{
	public function index()
    {
    	return view('admin.index');
    }

    public function activity()
    {
        $activity = Activity::all();
    	return view('admin.index', compact('activity'));
    }
}
