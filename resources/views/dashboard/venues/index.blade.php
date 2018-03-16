@extends('layouts.dashboard')

@section('secondary-content')
<h4>Orders</h4>
<table class="table table-bordered">
@foreach($venues as $venue)
	<tr>
		<td>ID</td>
		<td>Name</td>
		<td></td>
	</tr>
	<tr>
		<td>{{ $venue->id }}</td>
		<td>{{ $venue->name }}</td>
		<td>
			<a href="/dashboard/venues/{{ $venue->id }}" class="btn btn-primary">Open</a>
			<a href="/dashboard/venues/{{ $venue->id }}/edit" class="btn btn-secondary">Edit</a>
		</td>
	</tr>
	<tr>
		<td colspan="6"></td>
	</tr>
	
@endforeach
</table>
@endsection