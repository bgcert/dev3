@extends('layouts.app')

@section('content')

	@if(isset($category))
		<div class="cat-header" style="background: url(https://d3cwccg7mi8onu.cloudfront.net/1400x300/{{ $category->cover }}), rgba(0, 0, 0, 0.5);">
			<div class="container">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb pl-0">
						<li class="breadcrumb-item"><a href="/"> Начало</a></li>
						<li class="breadcrumb-item"><a href="/browse"> Обучения</a></li>
						<li class="breadcrumb-item active"> {{ $category->name }}</li>
					</ol>
				</nav>
				<h1>{{ $category->name }}</h1>
			</div>
		</div>
	@else

	<div class="container">
		<div class="row">
			@foreach($categories as $category)
			<div class="col-sm-3 my-2">
				<div
					class="cat-box"
					style="background: url('https://d3cwccg7mi8onu.cloudfront.net/270x172/{{ $category->cover }}'), rgba(0,0,0,.5);"
					onclick="window.location = '/browse/{{ $category->slug }}' + window.location.search;">
					<i class="{{ $category->icon }}"></i>
					<h5 class="text-center">{{ $category->name }}</h5>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	
	@endif
	<div class="container">
		<div class="mt-5">
			@include('partials.events-filtered', ['cities' => $cities, 'events' => $events])
		</div>
	</div>

@endsection
