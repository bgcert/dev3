<?php

namespace App\Http\Controllers\Publishers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
    	$company = \Auth::user()->company;
    	return view('dashboard.index', compact('company'));
    }

    public function getCompany()
    {
    	return \App\Company::with('company_detail')->where('user_id', \Auth::id())->first();
    }

    public function saveCompany()
    {
    	//dd(request()->company_detail);
    	$company = \App\Company::where('user_id', \Auth::id())->first();
    	$company->update(request()->company);
    	$company->company_detail->update(request()->company_detail);
    	
    	return 'ok';
    }
}
