@extends('layouts.app')

@push('header-scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/locale/bg.js"></script>
@endpush

@section('content')
<div class="container">
	<div class="ui grid">
		<div class="column">
			<carousel></carousel>		
		</div>
	</div>
	
    <h2>events</h2>
    <event-feed
		auth="{{ auth()->check() }}"
		>
	</event-feed>
</div>
@endsection