@extends('layouts.dashboard')

@section('secondary-content')
<h4>Themes</h4>
<table class="table table-bordered">
@foreach($themes as $theme)
	<tr>
		<td>ID</td>
		<td>Title</td>
		<td></td>
	</tr>
	<tr>
		<td>{{ $theme->id }}</td>
		<td>{{ $theme->title }}</td>
		<td>
			<a href="/dashboard/orders/{{ $theme->id }}" class="btn btn-primary">Open</a>
			<a href="/dashboard/orders/{{ $theme->id }}/edit" class="btn btn-secondary">Edit</a>
		</td>
	</tr>
	<tr>
		<td colspan="6"></td>
	</tr>
	
@endforeach
</table>
@endsection