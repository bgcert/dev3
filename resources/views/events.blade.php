@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/locale/bg.js"></script>
<div class="container">
    <h2>events</h2>
    <event-list
		auth="{{ auth()->check() }}"
		>
	</event-list>

</div>
@endsection