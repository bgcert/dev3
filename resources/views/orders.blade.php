@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $company->name }}'s dashboard</h2>
    <hr>
    @include('includes.dash-nav')
    <hr>
    <h4>Orders</h4>
    <table class="table table-bordered">
    @foreach($orders as $order)
    	<tr>
			<td>Date</td>
			<td>Title</td>
			<td>Contact person</td>
			<td>Quantity</td>
			<td></td>
		</tr>
		<tr>
			<td>{{ $order->created_at }}</td>
			<td>({{ $order->begin_at }}) - {{ $order->title }}</td>
			<td>{{ $order->name }}</td>
			<td>{{ $order->qty }}</td>
			<td>
				<a href="/dashboard/orders/{{ $order->id }}" class="btn btn-primary">Open</a>
				<a href="/dashboard/orders/{{ $order->id }}/edit" class="btn btn-secondary">Edit</a>
			</td>
		</tr>
		<tr>
			<td colspan="6"></td>
		</tr>
    	
    @endforeach
	</table>
</div>
@endsection