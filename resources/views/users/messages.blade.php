@extends('layouts.app')

@section('content')

<div class="ui container">
	<h1>Messanger</h1>	
	<messanger-app></messanger-app>
</div>

<!-- <messanger
	auth_id="{{ \Auth::id() }}"
	name="{{ \Auth::user()->name }}"
	picture="{{ \Auth::user()->picture }}"
	>
</messanger> -->

@endsection

@push('footer-scripts')
	<!-- <link href="/css/messanger.css" rel="stylesheet"> -->
@endpush