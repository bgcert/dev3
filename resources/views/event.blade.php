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
			    <p><button class="ui violet big basic button">Записвам се</button></p>
			</div>
		</div>

		<div class="row">
			<div class="column">
				<div class="ui divided items">
					<div class="item">
						<div class="image">
							<img src="{{ $event->theme->company->logo }}">
						</div>
						<div class="content">
							<a class="header">{{ $event->theme->company->name }}</a>
							<div class="meta">
								<span class="cinema">Union Square 14</span>
							</div>
							<div class="description">
								<p></p>
							</div>
							<div class="extra">
								<button class="ui facebook mini button">
									<i class="facebook icon"></i>
									Facebook
								</button>
								<button class="ui linkedin mini button">
									<i class="linkedin icon"></i>
									LinkedIn
								</button>
								<button class="ui instagram mini button">
									<i class="instagram icon"></i>
									Instagram
								</button>
								<button class="ui youtube mini button">
									<i class="youtube icon"></i>
									YouTube
								</button>
								<!-- <div class="ui label"><i class="globe icon"></i> Additional Languages</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="two column row">
			<div class="ten wide column">
				
				<p>
			    	{{ $event->theme->body }}
			    </p>
			    <div id="comments">
			    	<comments
			    		auth="{{ Auth::check() }}"
			    		type="theme"
				    	id="{{ $event->theme->id }}"
				    	user_id="{{ auth()->id() }}"
				    	>
				    </comments>	
			    </div>
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