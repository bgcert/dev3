@extends('layouts.app')

@section('description', $theme->company->name . ' - ' . $theme->excerpt)
@section('keywords', 'Обучение, ' . $theme->title . ', ' . $theme->category->name)
@section('title', $theme->company->name . ' - ' . $theme->title)

@push('canonical')
<link rel="canonical" href="/{{ $theme->slug }}/{{ $theme->id }}" />
@endpush

@section('content')

<div
	class="theme-header"
	style="background-image: url({{ 'https://d3cwccg7mi8onu.cloudfront.net/2000x400/' . $theme->cover }}), linear-gradient(rgba(4, 9, 30, 0.6), rgba(4, 9, 30, 0.8));">
	<div class="container">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="/"> Начало</a></li>
				<li class="breadcrumb-item"><a href="/browse"> Обучения</a></li>
				<li class="breadcrumb-item"><a href="/browse/{{ $theme->category->slug }}"> {{ $theme->category->name }}</a></li>
				<li class="breadcrumb-item active"> {{ $theme->title }}</li>
			</ol>
		</nav>
		<h1>{{ $theme->title }}</h1>
	</div>
</div>

<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
	<div class="container justify-content-md-end">
		<button class="btn btn-outline-light btn-lg mr-2 my-1 my-1-sm" @click.prevent="callContactPublisher">Изпрати запитване</button>
	</div>
</nav>

<contact-publisher
	:company-id="{{ $theme->company->id }}"
	about="{{ $theme->title }}">
</contact-publisher>

<div class="container mt-5">
	<div class="row">
		<div class="col-lg-8 col-md-12">
			<h3>{{ $theme->excerpt }}</h3>
			<p class="event-body">
				{{ $theme->body }}
			</p>
			<h4>Коментари</h4>
			<div id="comments">
				<comments
		    		auth="{{ Auth::check() }}"
		    		type="theme"
			    	id="{{ $theme->id }}"
			    	user_id="{{ auth()->id() }}">
			    </comments>
			</div>
		</div>
		<div class="col-lg-4 col-md-12">
			
			<div class="card">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<a href="/c/{{ $theme->company->slug }}">
							<img src="https://d3cwccg7mi8onu.cloudfront.net/fit-in/72x72/{{ $theme->company->logo }}" class="rounded float-left" alt="...">
						</a>
						<h5 class="card-title">{{ $theme->company->name }}</h5>
					</div>
					<div class="text-center mt-4">
						<a href="/c/{{ $theme->company->slug }}" class="btn btn-primary">Фирмен профил</a>
					</div>
				</div>
			</div>

			<h5 class="mt-5">Популярни теми</h5>
			<div class="row">
				@foreach($popularThemes as $theme)
					@include('partials.theme-box', ['theme' => $theme])
				@endforeach
			</div>
		</div>
	</div>

	<h4>Популярни обучения</h4>
	<div class="row">
		@foreach($relatedEvents as $event)
			@include('partials.event-box', ['event', $event])
		@endforeach
	</div>
</div>

@endsection