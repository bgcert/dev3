@extends('layouts.app')

@push('header-scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/locale/bg.js"></script>
@endpush

@section('content')
<div class="sub-nav" style="background-color: #fff; padding: 10px; border-bottom: 1px solid #DDDDDD;">
	<div class="ui container">
		<div class="ui breadcrumb">
			<a href="/" class="section">Начало</a>
			<i class="right angle icon divider"></i>
			<a href="/e" class="section">Събития</a>
			<i class="right angle icon divider"></i>
			<a href="/c/{{ $event->theme->company->slug }}" class="section">{{ $event->theme->company->name }}</a>
			<i class="right angle icon divider"></i>
			<div class="active section">{{ $event->theme->title }} - {{ Carbon\Carbon::parse($event->begin_at)->format('d M Y') }}</div>
		</div>
	</div>
</div>

<div class="ui container">
	
	<div class="ui padded grid">
		<div class="two column row">
			<div class="ten wide red column event-cover" style="background-image: url({{ $event->cover }});">
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
			    <p>
			    	<request-modal
						auth="{{ Auth::check() }}"
						classes="ui basic button"
						>
					</request-modal>
				</p>
			</div>
		</div>

		<div class="row">
			<div class="column">
				<div class="ui divided items">
					<div class="item">
						<div class="image">
							<img src="{{ $event->theme->company->company_detail->logo }}">
						</div>
						<div class="content">
							<div class="header">{{ $event->theme->company->name }}</div>
							<div class="meta">
								<span class="cinema">{{  $event->theme->company->company_detail->address }}</span>
							</div>
							<div class="description">
								<p></p>
							</div>
							<div class="extra">
								<a href="http://www.facebook.com/{{ $event->theme->company->company_detail->facebook }}" class="ui facebook mini button">
									<i class="facebook icon"></i>
									Facebook
								</a>
								<a href="http://www.facebook.com/{{ $event->theme->company->company_detail->instagram }}" class="ui instagram mini button">
									<i class="instagram icon"></i>
									Instagram
								</a>
								<a href="http://www.facebook.com/{{ $event->theme->company->company_detail->linkedin }}" class="ui linkedin mini button">
									<i class="linkedin icon"></i>
									LinkedIn
								</a>
								<a href="http://www.facebook.com/{{ $event->theme->company->company_detail->youtube }}" class="ui youtube mini button">
									<i class="youtube icon"></i>
									YouTube
								</a>
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