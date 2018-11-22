@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		@foreach($venues as $venue)
			<div class="col-lg-3 col-md-6 col-sm-12 py-2">
				@include('partials.venue-box', ['venue' => $venue])
			</div>
		@endforeach
	</div>
	<div class="indented">
		<div class="grid grid-1-1-1-1">
			
		</div>
	</div>
</div>
@endsection