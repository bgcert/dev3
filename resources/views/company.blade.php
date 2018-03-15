@extends('layouts.app')

@section('content')
<div class="container">
    <h2>company</h2>
	<table class="table table-bordered">
		<tr>
			<td>#{{ $company->id }}</td>
			<td>{{ $company->name }}</td>
			<td>{{ $company->user->name }}</td>
		</tr>
	</table>

	<hr>

	<h4>{{ $company->name }}'s themes</h4>
	<ul>
	@foreach($themes as $t)
		<li><a href="/theme/{{ $t->id }}">{{ $t->title }}</a></li>
	@endforeach
	</ul>

	<h4>{{ $company->name }}'s events</h4>
	<ul>
	@foreach($events as $e)
		<li><a href="/event/{{ $e->id }}">{{ $e->title }} - {{ $e->begin_at }}</a></li>
	@endforeach
	</ul>

	<h4>{{ $company->name }}'s venues</h4>
	<ul>
	@foreach($venues as $v)
		<li><a href="/venue/{{ $v->id }}">{{ $v->name }}</a></li>
	@endforeach
	</ul>
</div>
@endsection