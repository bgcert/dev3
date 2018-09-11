<?php

namespace App\Http\Controllers\Publishers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ResizableImage;
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

    // public function upload()
    // {
    // 	if (request()->file) {
    // 		$filename = $this->saveVenueImage(request()->file);
    // 	}
    // 	return $filename;
    // }

    public function saveCompanyLogo()
    {
    	$file = request()->file;
    	$prefix = 'lo_c' . \Auth::user()->company->id . '_';
    	$filename = $prefix . $this->unique_hash() . '.' . $file->getClientOriginalExtension();

    	// Make image from file
    	$image = Image::make($file);

    	// Save original file
    	$this->save($image, $filename, '/original/');

    	// Resize to m size
    	$this->resize($image, 300, 160);
    	$this->save($image, $filename);

    	// New image instance. Old one is already resized. Wtf?
    	$image = Image::make($file);
    	// Resize to l size
    	$this->resize($image, 1200, 400);
    	$this->save($image, $filename);

    	return $filename;
    }

    public function saveImage()
    {
    	$file = request()->file;

    	\Cloudder::upload($file, null);
    	$image = \Cloudder::getResult();
    	return $image['public_id'] . '.' . $image['format'];
    	// return \Storage::disk('s3')->put('/', $file);
    }
}
