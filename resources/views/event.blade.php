@extends('layouts.app')

@section('title', $event->theme->title)

@section('content')

<div class="event-page">
	<header style="background-image: url({{ 'https://d3cwccg7mi8onu.cloudfront.net/2000x400/' . $event->cover }}), linear-gradient(rgba(4, 9, 30, 0.6), rgba(4, 9, 30, 0.8));">
		<div class="content-container">
			<div class="breadcrumbs">
				<a href="/">Начало</a>
				<i class="fas fa-chevron-right"></i>
				<a href="/">Обучения</a>
				<i class="fas fa-chevron-right"></i>
				<a href="/">{{ $event->theme->category->name }}</a>
				<i class="fas fa-chevron-right"></i>
				<span class="current">{{ $event->theme->title }}</span>
			</div>
			<div class="header-content">
				<div class="grid grid-2-1">
					<div>
						<h1>{{ $event->theme->title }}</h1>	
					</div>
					<div>
						<div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="sub-header">
		<div class="content-container">
			<div class="grid grid-1-1">
				<div class="links">
					<a href="#" class="btn link">Информация</a>
					<span class="separator">|</span>
					<a href="#" class="btn link">Лектори</a>
				</div>

				<div class="buttons">
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
		</div>
	</div>
	<div class="content-container">
		<div class="content">
			<div class="grid grid-5-2">
				<div>
					<h2>{{ $event->theme->excerpt }}</h2>
					<p class="event-body">
						{{ $event->theme->body }}
					</p>

					@if($event->teachers == null)
					<div class="divider"></div>
					<h2 class="title"> Лектори</h2>
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
				    @endif
				</div>
				<div class="sidebar">
					<div class="details">
						<table>
							<tr>
								<td>
									<i class="far fa-calendar"></i>
								</td>
								<td>
									{{ $event->start_date_carbon }}
								</td>
							</tr>

							<tr>
								<td>
									<i class="far fa-clock"></i>
								</td>
								<td>
									{{ $event->start_at_carbon }} / {{ $event->end_at_carbon }} ч.
								</td>
							</tr>

							<tr>
								<td>
									<i class="fas fa-map-marked-alt"></i>
								</td>
								<td>
									{{ $event->city->name }}, {{ $event->address }}
								</td>
							</tr>

							<tr>
								<td colspan="2">
									<div class="price label">{{ $event->price }}.00 лв.</div>
								</td>
							</tr>
						</table>
					</div>

					<a href="/c/{{ $event->theme->company->slug }}" class="host">
						<div class="logo" style="background: url('https://d3cwccg7mi8onu.cloudfront.net/fit-in/72x72/{{ $event->theme->company->logo }}'), #fff;">
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

			<div id="comments">
				<comments
		    		auth="{{ Auth::check() }}"
		    		type="theme"
			    	id="{{ $event->theme->id }}"
			    	user_id="{{ auth()->id() }}">
			    </comments>
			</div>

			<div class="related mtop">
				<div class="title">Популярни обучения</div>
				<div class="grid grid-1-1-1-1">
		    		@foreach($relatedEvents as $event)
		    			@include('partials.event-box-alt', ['event', $event])
		    		@endforeach
		    	</div>
			</div>
		</div>
	</div>
</div>

@endsection