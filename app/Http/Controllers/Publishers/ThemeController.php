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
    	$requestData = $request->all();
    	if ($request->file) {
    		$name = $this->saveImage($request->file, 357, 178);
    		$requestData['cover'] = '/test/' . $name;
    	}

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
    	$theme = \App\Theme::find($id);
    	$requestData = $request->all();
    	if (isset($request->file)) {
    		$name = $this->saveImage($request->file, 357, 178);
    		$requestData['cover'] = '/test/' . $name;
    	}
    	
    	$theme->update($requestData);
    	return 'saved';
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
