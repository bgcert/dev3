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
    	return \App\Company::with('company_detail')->where('user_id', \Auth::id())->first();
    }

    public function saveCompany()
    {
    	$company = \App\Company::where('user_id', \Auth::id())->first();
    	$data = request()->all();
    	$company->update(request()->all());
    	if (request()->file) {
    		$name = $this->saveImage(request()->file, 357, 178);
    		$name = '/test/' . $name;
    		$data['logo'] = $name;
    	}

    	$company->company_detail->update($data);
    	return 'ok';
    }

    public function upload()
    {
    	if (request()->file) {
    		$name = $this->saveImage(request()->file, 357, 178);
    		$name = '/test/' . $name;
    	}
    	return $name;
    }
}
