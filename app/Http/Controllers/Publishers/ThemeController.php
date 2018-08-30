<?php

namespace App\Http\Controllers\Publishers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ResizableImage;

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

    	if ($request->file) {
    		$filename = $this->saveThemeCover($request->file, $theme->id);
    		$theme->cover = $filename;
    		$theme->save();
    	}

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
    	// $requestData = $request->all();
    	$theme->update($request->all());

    	if ($request->file) {
    		$filename = $this->saveThemeCover($request->file, $theme->id);
    		$theme->cover = $filename;
    		$theme->save();
    	}

    	// if (isset($request->file)) {
    	// 	$prefix = 't_' . 'c' . \Auth::user()->company()->id . '_';
    	// 	$name = $this->saveImage($request->file, $prefix);
    	// 	$requestData['cover'] = $name;
    	// }
    
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
}
