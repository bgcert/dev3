@extends('layouts.admin')

@section('content')
	@if(auth()->user()->role_id == 3)
		<admin></admin>
	@endif
@endsection