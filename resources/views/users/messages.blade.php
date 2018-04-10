@extends('layouts.app')

@section('content')
	
	<h2>messages</h2>
	<div class="ui grid">
		<div class="four wide column">
			<thread-list
				auth_id="{{ \Auth::id() }}"
				>
			</thread-list>
		</div>
		<div class="six wide column">
			<messages-feed
				id="{{ \Auth::id() }}"
				thread_id="1"
				>
			</messages-feed>
		</div>
	</div>

@endsection