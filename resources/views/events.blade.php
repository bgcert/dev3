@extends('layouts.app')

@push('header-scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/locale/bg.js"></script>
@endpush

@section('content')
<div class="container">
    <h2>events</h2>
    <event-list
		auth="{{ auth()->check() }}"
		>
	</event-list>
</div>
@endsection