<?php

namespace App\Http\Controllers\Publishers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ResizableImage;
use Image;

class ThemeController extends Controller
{
	use ResizableImage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return \Auth::user()->company->themes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$theme = \Auth::user()->company->themes()->create($request->all());

    	return $theme;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$data[0] = \App\Theme::find($id);
    	$data[1] = \App\Category::all();
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$theme = \App\Theme::find($id);
    	$theme->update($request->all());
    
    	return $theme;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return \App\Theme::destroy($id);
    }

	public function categories()
    {
        return \App\Category::all();
    }

    public function saveThemeCover()
    {
    	$file = request()->file;
    	return \Storage::disk('s3')->put('/', $file);

    	// $uploaded = \CloudImage::upload($file);
    	// return $uploaded->path;

    	// $prefix = 't_c' . \Auth::user()->company->id . '_';
    	// $filename = $prefix . $this->unique_hash() . '.' . $file->getClientOriginalExtension();

    	// // Make image from file
    	// $image = Image::make($file);

    	// // Save original file
    	// $this->save($image, $filename, 'original/');

    	// // Resize to m size
    	// $this->resize($image, 300, 160);
    	// $this->save($image, $filename);

    	// // New image instance. Old one is already resized. Wtf?
    	// $image = Image::make($file);
    	// // Resize to l size
    	// $this->resize($image, 1200, 400);
    	// $this->save($image, $filename);

    	// return $filename;
    }
}
