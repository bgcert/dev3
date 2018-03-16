@extends('layouts.app')

@section('content')
<div class="container">
	<h1>Venue</h1>
	<hr>
	<img src="{{ $venue->cover }}" style="height: 300px;">
    <h2>{{ $venue->name }}</h2>
    <p>
    	{{ $venue->description }}
    </p>
    <table>
    	<tr>
    		@foreach($images as $image)
    			<td><img src="{{ $image->filename }}" style="width: 200px;"></td>
    		@endforeach
  		</tr>
    </table>
    <p>
    	by <a href="/c/{{ $venue->company->slug }}">{{ $venue->company->name }}</a>
    </p>
    <h4>Comments</h4>
    <hr>
    @foreach($venue->comments as $comment)
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