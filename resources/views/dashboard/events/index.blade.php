@extends('layouts.dashboard')

@section('secondary-content')
<h4>Events</h4>
<table class="table table-bordered">
@foreach($events as $event)
	<tr>
		<td>ID</td>
		<td>Title</td>
		<td></td>
	</tr>
	<tr>
		<td>{{ $event->id }}</td>
		<td>{{ $event->begin_at }} - {{ $event->title }}</td>
		<td>
			<a href="/dashboard/events/{{ $event->id }}" class="btn btn-primary">Open</a>
			<a href="/dashboard/events/{{ $event->id }}/edit" class="btn btn-secondary">Edit</a>
		</td>
	</tr>
	<tr>
		<td colspan="6"></td>
	</tr>
	
@endforeach
</table>
@endsection