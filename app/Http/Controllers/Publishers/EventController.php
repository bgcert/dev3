<?php

namespace App\Http\Controllers\Publishers;

use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Http\Controllers\Controller;
use App\Traits\ResizableImage;
use Image;
use Cache;

class EventController extends Controller
{
	use ResizableImage;
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
    	$data[2] = \App\City::all();
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
    	$event = \Auth::user()->company->events()->create($request->all());

    	// Forget cache
    	Cache::forget('events');

    	if ($request->teachers) {
    		$event->teachers()->attach($request->teachers);
    	}

    	// Move image from temp folder. Need improvements!!!
    	$this->moveImage($request->cover);
    	
    	return $event;
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
    	$data[2] = \App\City::all();
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, $id)
    {

    	$event = \App\Event::find($id);
    	$event->update($request->all());

    	if ($request->teachers) {
    		$event->teachers()->sync($request->teachers);
    	}
    	
    	// Move image from temp folder. Need improvements!!!
    	$this->moveImage($request->cover);

    	return $event;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return \App\Event::destroy($id);
    }
}
