@extends('layouts.app')

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
    <h4>Comments</h4>
    <hr>
    @foreach($event->theme->comments as $comment)
    <div class="media">
    	<img class="mr-3" src="{{ $comment->user->picture }}" style="width: 28px;">
    	<div class="media-body">
    		<h5 class="mt-0"><a href="/user/{{ $comment->user->id }}">{{ $comment->user->name }}</a></h5>
    		<p>{{ $comment->body }}</p>	
    	</div>
    </div>   	
    @endforeach
</div>
@endsection