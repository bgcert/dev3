@extends('layouts.app')

@push('header-scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.js"></script>
@endpush

@section('content')
	<div class="ui main container">
		<dashboard></dashboard>	
	</div>
@endsection