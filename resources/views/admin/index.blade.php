@extends('layouts.admin')

@section('content')
	<div class="container mt-4">
		@if(auth()->user()->role_id == 3)
			<admin></admin>
		@endif
	</div>
@endsection