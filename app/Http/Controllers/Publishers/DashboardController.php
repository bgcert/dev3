<?php

namespace App\Http\Controllers\Publishers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ResizableImage;

class DashboardController extends Controller
{
	use ResizableImage;

    public function index()
    {
    	$company = \Auth::user()->company;
    	return ($company) ? view('dashboard', compact($company)) : abort(404);
    }

    public function getCompany()
    {
    	return \App\Company::where('user_id', \Auth::id())->first();
    }

    public function saveCompany()
    {
    	$company = \App\Company::where('user_id', \Auth::id())->first();
    	$data = request()->all();
    	if (request()->file) {
    		$name = $this->saveImage(request()->file);
    		$data['logo'] = $name;
    	}

    	$company->update($data);
    	
    	return $company;
    }

    public function upload()
    {
    	if (request()->file) {
    		$filename = $this->saveVenueImage(request()->file);
    	}
    	return $filename;
    }
}
