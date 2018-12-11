@extends('layouts.admin')

@section('content')
	<div class="container-fluid mt-4">
		@if(auth()->check() && auth()->user()->role_id == 3)
			<admin></admin>
		@endif
	</div>
@endsection