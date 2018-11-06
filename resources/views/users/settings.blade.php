@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="indented">
			@if(auth()->check())
			<account></account>
			@endif
		</div>
	</div>

@endsection