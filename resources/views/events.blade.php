	@extends('layouts.app')

@section('content')
<div class="container">
    <h2>events</h2>
    <event-list
		auth="{{ auth()->check() }}"
		>
	</event-list>

</div>
@endsection