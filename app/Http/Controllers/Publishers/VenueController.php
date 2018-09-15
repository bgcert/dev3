<?php

namespace App\Http\Controllers\Publishers;

use Illuminate\Http\Request;
use App\Http\Requests\VenueRequest;
use App\Http\Controllers\Controller;
use App\Traits\ResizableImage;
use Image;

class VenueController extends Controller
{
	use ResizableImage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \Auth::user()->company->venues;
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
    public function store(VenueRequest $request)
    {
    	$venue = \Auth::user()->company->venues()->create($request->except('images'));

    	if (isset($request->images)) {
	    	$images = [];
	    	foreach ($request->images as $filename) {
	    		array_push($images, ['filename' => $filename]);
	    	}
	    	$venue->venue_images()->createMany($images);
    	}

    	return $venue;
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
    	$cities = \App\City::all();
    	$venue = \App\Venue::find($id);
        return [$venue, $venue->venue_images, $cities];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VenueRequest $request, $id)
    {

    	$venue = \App\Venue::find($id);

    	$venue->update($request->all());

    	if (isset($request->images)) {
	    	$images = [];
	    	foreach ($request->images as $filename) {
	    		array_push($images, ['filename' => $filename]);
	    	}
	    	$venue->venue_images()->createMany($images);
    	}

    	if ($request->detached) {
        	foreach ($request->detached as $detached) {
        		$image = $venue->venue_images()->where('id', $detached)->first();
        	}
        }

    	return $venue;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$venue = \App\Venue::find($id);
    	
    	$venue->delete();
        return 'deleted';
    }
}
