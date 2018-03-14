@extends('layouts.app')

@section('content')
<div class="container">
    <h2>events</h2>
    @foreach($events as $e)
    <table>
    	<h4>{{ $e->theme->title }}</h4>
    	<h5>{{ $e->test }}</h5>
    	<hr>
    </table>
    @endforeach
</div>
@endsection