@extends('layouts.app')

@section('content')
    <event-feed
		auth="{{ auth()->check() }}"
		slug="{{ Request::route('slug') }}">
	</event-feed>
@endsection