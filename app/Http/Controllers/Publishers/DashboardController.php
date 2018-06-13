<?php

namespace App\Http\Controllers\Publishers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
    	$company = \Auth::user()->company;
    	return ($company) ? view('dashboard', compact($company)) : abort(404);
    }

    public function getCompany()
    {
    	return \App\Company::with('company_detail')->where('user_id', \Auth::id())->first();
    }

    public function saveCompany()
    {
    	$company = \App\Company::where('user_id', \Auth::id())->first();
    	$company->update(request()->company);
    	$company->company_detail->update(request()->company_detail);
    	return 'ok';
    }
}
