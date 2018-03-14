<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function e()
    {
    	$events = \App\Event::with('theme', 'theme.company')->get();

    	return view('events', compact('events'));
    }

    public function v()
    {
    	$venues = \App\Venue::with('company')->get();
    	return view('venues', compact('venues'));
    }
}
