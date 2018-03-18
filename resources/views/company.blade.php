@extends('layouts.app')

@section('content')
<div class="container">
    <h2>company</h2>
	<table class="table table-bordered">
		<tr>
			<td>#ID</td>
			<td>{{ $company->id }}</td>
		</tr>
		<tr>
			<td>Name</td>
			<td>{{ $company->name }}</td>
		</tr>
		<tr>
			<td>Logo</td>
			<td><img src="{{ $company->logo }}" style="width: 60px;"></td>
		</tr>
		<tr>
			<td>Cover</td>
			<td><img src="{{ $company->cover }}" style="width: 240px;"></td>
		</tr>
		<tr>
			<td>User</td>
			<td>{{ $company->user->name }}</td>
		</tr>
		<tr>
			<td>Followed by:</td>
			<td>
				<ul class="list-inline">
					@foreach($company->followers as $follower)
					<li class="list-inline-item"><img src="{{ $follower->picture }}" style="width: 20px;"></li>
					@endforeach
				</ul>
			</td>
		</tr>
		<tr>
			<td>--</td>
			<td>
				@auth
				<follow
					followed="{{ $company->followers->contains(auth()->user()) }}"
					company_id="{{ $company->id }}"
					>
				</follow>
				@endauth
			</td>
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