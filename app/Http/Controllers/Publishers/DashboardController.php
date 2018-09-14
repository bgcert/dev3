<?php

namespace App\Http\Controllers\Publishers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ResizableImage;
use Illuminate\Support\Facades\Validator;
use Image;

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
    	$company->update(request()->all());
    	return $company;
    }

    public function saveImage()
    {
    	$validator = request()->validate(['file' => 'image|mimes:jpeg,png,gif|max:2400']);

    	if (!$validator) {
    		return $validator;
        	// return response()->json(['error' => $validator]);
        }

		$file = request()->file;
        return \Storage::disk('s3')->put('/', $file);
    }
}
