@extends('layouts.app')

@section('content')

<messanger
	auth_id="{{ \Auth::id() }}"
	name="{{ \Auth::user()->name }}"
	picture="{{ \Auth::user()->picture }}"
	>
</messanger>

@endsection

@push('footer-scripts')
	<link href="/css/messanger.css" rel="stylesheet">
@endpush