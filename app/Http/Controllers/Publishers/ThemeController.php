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
    	$requestData = $request->all();
    	$name = $this->saveImage($requestData['cover']);
    	$requestData['cover'] = '/test/' . $name;

    	return \Auth::user()->company->themes()->create($requestData);
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

    public function saveImage($file)
    {
    	//$file = request()->file;
    	$extension = $file->getClientOriginalExtension();
    	$img = Image::make($file);

		// now you are able to resize the instance
		$img->resize(request()->width, null, function ($constraint) {
		    $constraint->aspectRatio();
		});
		
		// Generate random name
		$newName = md5(microtime()) . '.' . $extension;

		// finally we save the image as a new file
		$img->save(public_path('test/') . $newName);

    	return $newName;
    }
}
