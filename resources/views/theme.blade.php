@extends('layouts.app')

@push('header-scripts')
	<style>
		.cover {
			background-color: #505763;
			background-size: cover;
    		background-position: 50%;
		}
		.overlay {
			height: 100%;
			background-color: rgba(0,0,0,0.2);
			min-height: 400px;
		}
		.flex-center {
			 display: flex !important;
			 justify-content:center;
			 align-items: center;
		}
		.info { color: white; }
		.details { border: 1px solid red; flex: 1; }
		.flex { display: flex; }
		.logo { flex: 2; }
		.company-details { flex: 3; text-align: center; }
		.event-header { padding: 30px 0 !important; }
	</style>
@endpush

@section('content')
<div class="cover" style="background-image: url({{ 'https://d3cwccg7mi8onu.cloudfront.net/2000x400/' . $theme->cover }});">
	<div class="overlay">
		<div class="ui container">
			<div class="ui basic segment">
				<div class="ui breadcrumb inverted-breadcrumb">
					<a href="/" class="section">Начало</a>
					<i class="right angle icon divider"></i>
					<div class="active section">{{ $theme->title }}</div>
				</div>
			</div>
			<div class="ui grid event-header">
				<div class="flex-center ten wide column ">
					<div class="info">
						<h1 class="title">{{ $theme->title }}</h1>
						<p>{{ $theme->excerpt }}</p>
					</div>	
				</div>
				<div class="six wide column">
					<div class="ui segment">
						<div class="flex">
							<div class="logo">
								<a href="/c/{{ $theme->company->slug }}">
									<img class="ui image" src="https://d3cwccg7mi8onu.cloudfront.net/fit-in/250x250/{{ $theme->company->logo }}">
								</a>
							</div>
							<div class="company-details">
								<h3>{{ $theme->company->name }}</h3>
								<a href="/c/{{ $theme->company->slug }}" class="ui basic button">Фирмен профил</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="ui container mt-20">
	
	<div class="ui segment padded grid">

		<div class="two column row">
			<div class="ten wide column">
				<p style="white-space: pre-line;">{{ $theme->body }}</p>

			    <!-- <google-map></google-map> -->
			    <div id="comments">
			    	<div class="ui divider"></div>
			    	<comments
			    		auth="{{ Auth::check() }}"
			    		type="theme"
				    	id="{{ $theme->id }}"
				    	user_id="{{ auth()->id() }}">
				    </comments>	
			    </div>
			</div>
			<div class="six wide column">
				<h3 class="ui dividing header">Популярни обучения</h3>
				<related-feed
					auth="{{ auth()->check() }}"
					company_id="{{ $theme->company->id }}">
				</related-feed>
			</div>
		</div>

	</div>
</div>
@endsection