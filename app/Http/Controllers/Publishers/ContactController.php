<?php

namespace App\Http\Controllers\Publishers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$id = \Auth::user()->company->id;
        return \App\ContactPublisher::where('company_id', $id)->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$contact = \App\ContactPublisher::find($id);
    	// Mark as read
    	$contact->read_at = \Carbon\Carbon::now();
    	$contact->save();
        return $contact;
    	// return view('venue', compact('venue', 'images'));
    }

    // Mark as undread maybe
    public function unread()
    {
    	$contact = \App\ContactPublisher::find(request()->id);
    	$contact->read_at = null;
    	$contact->save();
        return $contact;
    }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return \App\ContactPublisher::destroy($id);
    }
}
