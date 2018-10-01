<?php

namespace App\Http\Controllers\Publishers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$id = \Auth::user()->company->id;
    	$orders = \App\Order::withCount('participants')->where('company_id', $id)->orderByDesc('created_at')->get();

        return $orders;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$order = \App\Order::with('user', 'participants', 'details')->withCount('participants')->where('id', $id)->first();
    	$order->read = true;
    	$order->save();
    	return $order;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    	// dd($request->all());
        $order = \App\Order::find($id);
        $order->status = $request->status;
    	$order->note = $request->note;
    	$order->save();
    	return $order;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return \App\Order::destroy($id);
    }

    // public function save()
    // {
    // 	$order = \App\Order::find(request()->order);

    // 	$order->status = request()->status;
    // 	$order->notes = request()->notes;
    // 	$order->save();
    // 	return $order;
    // }
}
