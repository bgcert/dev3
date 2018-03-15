@extends('layouts.app')

@section('content')
<div class="container">
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
</div>
@endsection