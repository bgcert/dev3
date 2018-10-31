@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="indented">
			<div class="grid">
				@foreach($categories as $category)
					<a 
						class="cat-box" style="background: url('https://placeimg.com/640/480/any?i={{ $category->id  }}'), rgba(0,0,0,.56);"
						href="#"
						onclick="window.location = '/browse/{{ $category->slug }}' + window.location.search;">
						{{ $category->name }}
					</a>
				@endforeach
			</div>
			@include('partials.events-filtered', ['cities' => $cities, 'events' => $events])
		</div>
	</div>

@endsection
