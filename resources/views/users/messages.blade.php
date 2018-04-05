@extends('layouts.app')

@section('content')
	
	<h2>messages</h2>
	<div class="ui grid">
		<div class="six wide column">
			<div class="ui large relaxed list">
				@foreach($threads as $thread)
				<div class="item">
					<img class="ui avatar image" src="{{ $thread->firstParticipant->user->picture }}">
					<div class="content">
						<a class="header">{{ $thread->firstParticipant->user->name }}</a>
						<div class="description">{{ $thread->lastMessage->userName . $thread->lastMessage->body }}</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>

@endsection