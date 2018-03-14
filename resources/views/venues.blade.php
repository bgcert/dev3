@extends('layouts.app')

@section('content')
<div class="container">
    <h2>venues</h2>
    @foreach($venues as $v)
    <table>
    	<h4>{{ $v->name }}</h4>
    	<hr>
    </table>
    @endforeach
</div>
@endsection