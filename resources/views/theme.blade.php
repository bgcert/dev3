@extends('layouts.app')

@section('content')
<div class="ui container">
	<h1>Theme</h1>
	<hr>
	<img src="{{ $theme->cover }}" style="height: 300px;">
    <h2>{{ $theme->title }}</h2>
    <p>
    	{{ $theme->body }}
    </p>
    <p>
    	by <a href="/c/{{ $theme->company->slug }}">{{ $theme->company->name }}</a>
    </p>
</div>
@endsection