@extends('layouts.app')

@push('header-scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.js"></script>
@endpush

<!-- <script>
    window.company = @json(auth()->user()->company);
</script> -->

@section('content')
	<div class="container">
		<div class="indented">
			@if(auth()->user()->role_id == 2)
			<dashboard
				event_publish="{{ auth()->user()->company->event_publish }}"
				venue_publish="{{ auth()->user()->company->venue_publish }}">
			</dashboard>	
			@else
			<h4>Нямате достъп до този раздел</h4>
			@endif
		</div>
	</div>
@endsection