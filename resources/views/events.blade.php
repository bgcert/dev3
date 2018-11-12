@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="indented mtop">
			<div class="grid">
				@foreach($categories as $category)
					<a 
						class="cat-box" style="background: url('https://placeimg.com/640/480/any?i={{ $category->id  }}'), rgba(0,0,0,.56);"
						href="#"
						onclick="window.location = '/browse/{{ $category->slug }}' + window.location.search;">
						<i class="{{ $category->icon }}"></i>
						<div class="cat-name"> {{ $category->name }}</div>
					</a>
				@endforeach
			</div>
			@include('partials.events-filtered', ['cities' => $cities, 'events' => $events])
		</div>
	</div>

@endsection
