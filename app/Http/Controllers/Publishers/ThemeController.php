<?php

namespace App\Http\Controllers\Publishers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class ThemeController extends Controller
{
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
    	$path  = public_path('test/');
    	$file = $request->cover;
    	$originalName = explode('.', $request->filename);
    	$uploadName = time() . '.' . end($originalName); // end() is the last element if the array
    	$image = Image::make($file);
    	$image->resize($request->width, null, function ($constraint) {
		    $constraint->aspectRatio();
		});

    	$image->save($path . $uploadName);
    	
    	return 'image saved';

    	$originalImage = $request->cover;
		$savedImage = Image::make($originalImage);
		$savedImage->save($path . $originalImage->getClientOriginalName());
    	return 'image saved';
    	$img = Image::make('public/foo.jpg');
    	return $request->position;
    	return \Auth::user()->company->themes()->create($request->all());
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
    	return \App\Theme::where('id', $id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

	public function categories()
    {
        return \App\Category::all();
    }

    public function setCover()
    {
    	dd(request());
    }
}
