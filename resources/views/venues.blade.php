@extends('layouts.app')

@section('content')
<div class="container">
	<div class="indented">
		<div class="grid grid-1-1-1-1">
			@foreach($venues as $venue)
				@include('partials.venue-box', ['venue' => $venue])
			@endforeach
		</div>
	</div>
</div>
@endsection