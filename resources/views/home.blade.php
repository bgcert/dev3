@extends('layouts.app')

@section('content')

@push('header-scripts')
    <style>
		.category-box {
			display: flex;
			border-radius: 3px;
			align-items: center;
			justify-content: center;
			height: 150px;
			color: white;
		}
	</style>
@endpush

<div class="ui container">
	<div class="ui grid">
		<div class="column">
			<carousel></carousel>		
		</div>
	</div>

	<div class="ui center aligned grid">
		<div class="column">
			<h3 class="ui header">
				Seminari365 is growing fast. Want to see just how much? Sign up and we'll let you know
			</h3>
		</div>
	</div>

	<div class="ui hidden divider"></div>

	<div class="ui four column grid">
		@foreach($categories as $category)
		<div class="column">
			<a
				href="/browse/{{ $category->slug }}"
				class="category-box"
				style="background-image: linear-gradient(0deg,rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url(https://placeimg.com/300/150/{{ $category->id }});">
				<h1 class="ui inverted header">{{ $category->name }}</h1>
			</a>
		</div>
		@endforeach
	</div>

	<div id="search"></div>

	<event-feed></event-feed>
	
</div>
@endsection