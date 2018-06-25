@extends('layouts.app')

@push('header-scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/locale/bg.js"></script>
@endpush

@section('content')
<div class="ui container">
	<div class="ui grid">
		<div class="column">
			<carousel></carousel>		
		</div>
	</div>
	
    <event-feed
		auth="{{ auth()->check() }}"
		>
	</event-feed>
</div>
@endsection