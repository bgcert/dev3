@extends('layouts.app')

@section('content')

<div class="ui container">
	<messanger :owner="{{ auth()->user() }}"></messanger>
</div>

@endsection