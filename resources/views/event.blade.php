@extends('layouts.app')

@section('title', $event->theme->title)

@section('content')
<div class="container">
	<header class="event">
		<div
			class="cover"
			style="background-image: url({{ 'https://d3cwccg7mi8onu.cloudfront.net/2000x400/' . $event->cover }}), linear-gradient(rgba(4, 9, 30, 0.6), rgba(4, 9, 30, 0.4));">
			<div class="add-links"><a href="#">+ Добави обучение |</a> <a href="#">+ Добави зала</a></div>

			<div class="container indented">
				<div class="content">
					<div class="title">
						{{ $event->theme->title }}
					</div>
					<div class="excerpt">
						<p>{{ $event->theme->excerpt }}</p>
					</div>
				</div>
			</div>
		</div>
		<div class="sub-header aligned">
			<div class="links">
				<a href="#" class="info">Информация</a>
				<a href="#" class="teachers">Лектори</a>
			</div>

			<div class="buttons aligned" style="display: flex;">
				<contact-publisher
					button-text="Изпрати запитване"
					:company-id="{{ $event->theme->company->id }}"
					about="{{ $event->theme->title }}"
					btn-class="inverted btn">
				</contact-publisher>
				<request-modal
					:id="{{ json_encode($event->id) }}"
					title="{{ $event->theme->title }}"
					:auth="{{ json_encode(Auth::check()) }}"
					classes="btn white">
				</request-modal>
			</div>
		</div>
	</header>

	<section class="content mtop">
		<div class="container indented">
			<div class="grid grid-5-2">
				<div>
					<div style="white-space: pre-line;">
				    	{{ $event->theme->body }}
				    </div>

				    <h1>Лектори</h1>
				    <div class="teacher-list">
				    	@foreach($event->teachers as $teacher)
				    	<div class="teacher">
				    		<div class="photo">
				    			<img src="https://d3cwccg7mi8onu.cloudfront.net/100x100/{{ $teacher->image }}" class="ui circular image">
				    		</div>
				    		<div class="info">
				    			<h4 class="name">{{ $teacher->name}}</h4>
				    			<p class="details">{{ $teacher->details }}</p>
				    		</div>
				    	</div>
				    	@endforeach
				    </div>
				</div>

				<div class="event-details">
					<table class="info">
						<tr>
							<td class="underlined">
								<i class="far fa-calendar"></i>
								{{ $event->start_date_carbon }}
							</td>
						</tr>

						<tr>
							<td class="underlined">
								<i class="far fa-clock"></i>
								{{ $event->start_at_carbon }} / {{ $event->end_at_carbon }} ч.
							</td>
						</tr>

						<tr>
							<td>
								<i class="fas fa-map-marked-alt"></i>
								{{ $event->city->name }}, {{ $event->address }}
							</td>
						</tr>

						<tr>
							<td><div href="#" class="label price">{{ $event->price }}.00 лв.</div></td>
						</tr>
					</table>
					<a href="/c/{{ $event->theme->company->slug }}" class="company">
						<div class="logo">
							<img src="https://d3cwccg7mi8onu.cloudfront.net/72x72/{{ $event->theme->company->logo }}">
						</div>
						<div class="name">
							{{ $event->theme->company->name }}
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
	    	id="{{ $event->theme->id }}"
	    	user_id="{{ auth()->id() }}">
	    </comments>

	    <section class="indented">
	    	<div class="title">Подобни обучения</div>

	    	<div class="grid grid-1-1-1-1">
	    		@foreach($relatedEvents as $event)
	    			@include('partials.event-box-alt', ['event', $event])
	    		@endforeach
	    	</div>
	    </section>
		
	</section>
	
</div>

@endsection