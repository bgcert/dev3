@extends('layouts.app')

@section('content')
<div class="container">
	<header class="theme">
		<div
			class="cover"
			style="background-image: url({{ 'https://d3cwccg7mi8onu.cloudfront.net/2000x400/' . $theme->cover }}), linear-gradient(rgba(4, 9, 30, 0.6), rgba(4, 9, 30, 0.4));">
			<div class="add-links"><a href="#">+ Добави обучение |</a> <a href="#">+ Добави зала</a></div>

			<div class="container indented">
				<div class="content">
					<div class="title">
						{{ $theme->title }}
					</div>
					<div class="excerpt">
						<p>{{ $theme->excerpt }}</p>
					</div>
				</div>
			</div>
		</div>
		<div class="sub-header">
			<div class="container indented">
				<div class="aligned">
					<div class="links">
						<a href="#" class="info">Информация</a>
						<a href="#" class="teachers">Лектори</a>
					</div>

					<div class="buttons" style="display: flex;">
						<contact-publisher
							button-text="Изпрати запитване"
							:company-id="{{ $theme->company->id }}"
							about="{{ $theme->title }}"
							btn-class="inverted btn">
						</contact-publisher>
					</div>
				</div>
			</div>
		</div>
	</header>

	<section class="content">
		<div class="container indented">
			<div class="grid grid-2-1">
				<div>
					<p style="white-space: pre-line;">
				    	{{ $theme->body }}
				    </p>
				</div>

				<div class="theme-details">
					<a href="/c/{{ $theme->company->slug }}" class="company">
						<div class="logo">
							<img src="https://d3cwccg7mi8onu.cloudfront.net/72x72/{{ $theme->company->logo }}">
						</div>
						<div class="name">
							{{ $theme->company->name }}
						</div>
					</a>
					<div class="popular">
						@foreach($popularThemes as $theme)
							@include('partials.theme-box', ['theme' => $theme])
						@endforeach
					</div>
				</div>
			</div>
		</div>

		<comments
    		auth="{{ Auth::check() }}"
    		type="theme"
	    	id="{{ $theme->id }}"
	    	user_id="{{ auth()->id() }}">
	    </comments>

	    <div class="indented">
	    	<h3>Предстоящи събития на {{ $theme->company->name }}</h3>

	    	<div class="grid">
	    		@foreach($relatedEvents as $event)
	    			@include('partials.event-box-alt', ['event', $event])
	    		@endforeach
	    	</div>
	    </div>
		
	</section>
	
</div>

@endsection