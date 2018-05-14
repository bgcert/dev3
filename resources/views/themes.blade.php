@extends('layouts.app')

@section('content')
<div class="ui container">
	<h1>All Themes</h1>
	<hr>
	<ul>
		@foreach($themes as $theme)
		<li>{{ $theme->title }} - <a href="#">{{ ($theme->isLiked->count() > 0) ? 'unlike' : 'like' }}</a></li>
		@endforeach
	</ul>
</div>
@endsection