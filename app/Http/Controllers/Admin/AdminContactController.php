<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminContactController extends Controller
{
    public function index()
    {
        $contacts = \App\ContactPublisher::with('company')->latest()->get();
    	return $contacts;
    }
}
