@extends('layouts.app')

@section('content')
<div class="container">
	<h1>{{ $user->name }}</h1>
	<hr>
	<img src="{{ $user->picture }}" style="height: 60px;">
</div>
@endsection