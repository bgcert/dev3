@extends('layouts.app')

@push('header-scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/locale/bg.js"></script>
@endpush

@section('content')
<div class="container">
	<h1>Event</h1>
	<hr>
	<img src="{{ $event->cover }}" style="height: 300px;">
    <h2>{{ $event->theme->title }}</h2>
    <div>
    	{{ $event->begin_at }}
    </div>
    <p>
    	{{ $event->theme->body }}
    </p>
    <p>
    	by <a href="/c/{{ $event->theme->company->slug }}">{{ $event->theme->company->name }}</a>
    </p>
    <comments
    	id="{{ $event->theme->id }}"
    	user_id="{{ auth()->id() }}"
    	>
    </comments>
</div>
@endsection