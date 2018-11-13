@extends('layouts.app')

@section('content')

	<div class="container">
		@if(isset($category))
		<div class="category-cover" style="background: url(https://d3cwccg7mi8onu.cloudfront.net/1400x300/{{ $category->cover }}), rgba(0, 0, 0, 0.3);">
			<div class="bcrumbs">
				<a href="/">Начало</a>
				<i class="fas fa-chevron-right"></i>
				<a href="/browse">Обучения</a>
			</div>
			<div class="title">
				{{ $category->name }}
			</div>
		</div>

		@else
			<div class="indented mtop">
				<div class="grid">
					@foreach($categories as $category)
						<a 
							class="cat-box" style="background: url('https://d3cwccg7mi8onu.cloudfront.net/270x172/{{ $category->cover }}'), rgba(0,0,0,.4);"
							href="#"
							onclick="window.location = '/browse/{{ $category->slug }}' + window.location.search;">
							<i class="{{ $category->icon }}"></i>
							<div class="cat-name"> {{ $category->name }}</div>
						</a>
					@endforeach
				</div>
			</div>
		@endif
		<div class="indented mtop">
			@include('partials.events-filtered', ['cities' => $cities, 'events' => $events])
		</div>
	</div>

@endsection
