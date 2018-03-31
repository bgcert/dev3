@extends('layouts.app')

@push('header-scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/locale/bg.js"></script>

	<style>
		.event-cover {
			background-image: url({{ $event->cover }});
			background-size: cover;
			background-repeat: no-repeat;
			height: 400px;
		}
	</style>
@endpush

@section('content')
<div class="container">
	<div class="ui padded grid">
		<div class="two column row">
			<div class="ten wide red column event-cover">
				<!-- <img src="{{ $event->cover }}"> -->
			</div>
			<div class="six wide olive column">
				<div class="ui basic center aligned segment">
					<div class="ui mini statistic">
						<div class="value">
							{{ Carbon\Carbon::parse($event->begin_at)->format('d') }}
						</div>
						<div class="label">
							{{ Carbon\Carbon::parse($event->begin_at)->format('M') }}
						</div>
					</div>	
				</div>
				<h2>{{ $event->theme->title }}</h2>
				<p>
			    	by <a href="/c/{{ $event->theme->company->slug }}">{{ $event->theme->company->name }}</a>
			    </p>
			</div>
		</div>
		<div class="two column row">
			<div class="ten wide column">
				<p>
			    	{{ $event->theme->body }}
			    </p>
			    <comments
			    	id="{{ $event->theme->id }}"
			    	user_id="{{ auth()->id() }}"
			    	>
			    </comments>
			</div>
			<div class="six wide column">
				<div class="ui large horizontal divided list">
					<div class="item">
						<img class="ui avatar image" src="/images/avatar/small/helen.jpg">
						<div class="content">
							<div class="header">Helen</div>
						</div>
					</div>
					<div class="item">
						<img class="ui avatar image" src="/images/avatar/small/christian.jpg">
						<div class="content">
							<div class="header">Christian</div>
						</div>
					</div>
					<div class="item">
						<img class="ui avatar image" src="/images/avatar/small/daniel.jpg">
						<div class="content">
							<div class="header">Daniel</div>
						</div>
					</div>
				</div>
				<h3 class="ui dividing header">Популярни обучения</h3>
				<related-feed
					auth="{{ auth()->check() }}"
					company_id="{{ $event->theme->company->id }}"
					>
				</related-feed>
			</div>
		</div>

	</div>
</div>
@endsection