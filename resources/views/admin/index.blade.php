@extends('layouts.admin')

@section('secondary-content')
	
	<h2>admin home</h2>
	<ul>
		@foreach($activity as $activity)
		<li>{{ $activity->description }}</li>
		@endforeach
	</ul>

@endsection