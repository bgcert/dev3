@extends('layouts.app')

@section('content')

@push('header-scripts')
    <style>
		.category-box {
			display: flex;
			border-radius: 3px;
			align-items: center;
			justify-content: center;
			height: 250px;
			background: linear-gradient(0deg,rgba(0,0,0,0.2), rgba(0,0,0,0.2))
		}
	</style>
@endpush

<div class="ui container">
	<div class="ui grid">
		<div class="column">
			<carousel></carousel>		
		</div>
	</div>

	<div class="ui hidden divider"></div>

	<div class="ui four column padded grid">
		@foreach($categories as $category)
		<div class="column">
			<div class="category-box" style="background: url(https://placeimg.com/300/250/{{ $category->id }});">
				<h1><a href="#" style="color: white;">{{ $category->name }}</a></h1>
			</div>
		</div>
		@endforeach
	</div>

	<event-feed></event-feed>
	
</div>
@endsection