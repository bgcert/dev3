@extends('layouts.app')

@section('content')
<div class="container indented">
	<div class="grid">
		@foreach($venues as $venue)
			@include('partials.venue-box', ['venue' => $venue])
		@endforeach
	</div>
</div>
@endsection