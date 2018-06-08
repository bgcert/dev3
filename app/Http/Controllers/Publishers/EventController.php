<?php

namespace App\Http\Controllers\Publishers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \App\Event::byCompany(\Auth::user()->company->id)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data[0] = \Auth::user()->company->themes;
    	$data[1] = \Auth::user()->company->teachers;
        return $data;
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

    	$requestData['teachers'] = explode(',', $requestData['teachers']);

    	$event = \Auth::user()->company->events()->create($requestData);
    	
    	$event->teachers()->attach($requestData['teachers']);
    	
    	return 'saved maybe';
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
    	$data[0] = \App\Event::find($id)->load('theme', 'teachers');
    	$data[1] = \Auth::user()->company->teachers;
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
    	$event = \App\Event::where('id', $id)->first();
		$event->update($request->except(['teachers']));

        $event->teachers()->detach();

    	return $event->teachers()->attach($request->teachers);
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
