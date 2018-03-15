<?php

namespace App\Http\Controllers\Publishers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
    	$company = \Auth::user()->company;
    	return view('dashboard', compact('company'));
    }
}
