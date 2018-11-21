@extends('layouts.app')

@section('title', $event->theme->title)

@section('content')

<div
	class="event-header"
	style="background-image: url({{ 'https://d3cwccg7mi8onu.cloudfront.net/2000x400/' . $event->cover }}), linear-gradient(rgba(4, 9, 30, 0.6), rgba(4, 9, 30, 0.8));">
	<div class="container">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb pl-0">
				<li class="breadcrumb-item"><a href="/"> Начало</a></li>
				<li class="breadcrumb-item"><a href="/browse"> Обучения</a></li>
				<li class="breadcrumb-item"><a href="/browse/{{ $event->theme->category->slug }}"> {{ $event->theme->category->name }}</a></li>
				<li class="breadcrumb-item active"> {{ $event->theme->title }}</li>
			</ol>
		</nav>
		<h1>{{ $event->theme->title }}</h1>
	</div>
</div>

<div class="event-sub-header py-2">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-6 d-flex justify-content-start">
				<button type="button" class="btn btn-link btn-lg px-1">Информация</button>
				<span class="btn btn-link btn-lg disabled">|</span>
				<button type="button" class="btn btn-link btn-lg px-1">Лектори</button>
			</div>

			<div class="col-4 d-flex justify-content-end">
				<!-- <button type="button" class="btn btn-outline-light btn-lg">Primary</button>
				<button type="button" class="btn btn-light btn-lg">Primary</button> -->
				<contact-publisher
					button-text="Изпрати запитване"
					:company-id="{{ $event->theme->company->id }}"
					about="{{ $event->theme->title }}"
					btn-class="btn btn-outline-light btn-lg">
				</contact-publisher>
				<request-modal
					:id="{{ json_encode($event->id) }}"
					title="{{ $event->theme->title }}"
					:auth="{{ json_encode(Auth::check()) }}"
					classes="btn btn-light btn-lg ml-3">
				</request-modal>
			</div>
		</div>		
	</div>
</div>

<div class="container mt-5">
	<div class="row">
		<div class="col-lg-8 col-md-12">
			<h3>{{ $event->theme->excerpt }}</h3>
			<p class="event-body">
				{{ $event->theme->body }}
			</p>
			<h4>Коментари</h4>
			<div id="comments">
				<comments
		    		auth="{{ Auth::check() }}"
		    		type="theme"
			    	id="{{ $event->theme->id }}"
			    	user_id="{{ auth()->id() }}">
			    </comments>
			</div>
		</div>
		<div class="col-lg-4 col-md-12">
			<div class="card bg-light mb-3">
				<div class="card-header">Header</div>
				<div class="card-body">
					<table class="table ">
						<tbody>
							<tr>
								<th scope="row"><i class="far fa-calendar"></i></th>
								<td>{{ $event->start_date_carbon }}</td>
							</tr>
							<tr>
								<th scope="row"><i class="far fa-clock"></i></th>
								<td>{{ $event->start_at_carbon }} / {{ $event->end_at_carbon }} ч.</td>
							</tr>
							<tr>
								<th scope="row"><i class="fas fa-map-marked-alt"></i></th>
								<td>{{ $event->city->name }}, {{ $event->address }}</td>
							</tr>
							<tr>
								<td colspan="2"><div class="btn btn-primary btn-lg btn-block">{{ $event->price }}.00 лв.</div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="card">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<a href="/c/{{ $event->theme->company->slug }}">
							<img src="https://d3cwccg7mi8onu.cloudfront.net/fit-in/72x72/{{ $event->theme->company->logo }}" class="rounded float-left" alt="...">
						</a>
						<h5 class="card-title">{{ $event->theme->company->name }}</h5>
					</div>
					<!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
					<div class="text-center mt-4">
						<a href="#" class="btn btn-primary">Фирмен профил</a>
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