@extends('layouts.app')

@section('content')
<div class="ui container">
	
    <event-feed
		auth="{{ auth()->check() }}"
		slug="{{ Request::route('slug') }}">
	</event-feed>

</div>
@endsection