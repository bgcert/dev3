@extends('layouts.app')

@section('description', $event->theme->company->name . ' - ' . $event->theme->title . ' - ' . preg_replace('/[\n\r]/', ' ', $event->theme->excerpt))
@section('keywords', 'Обучение, ' . $event->theme->title . ', ' . $event->theme->category->name)
@section('title', $event->theme->company->name . ' - ' . $event->theme->title)

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
		<h2>{{ $event->theme->title }}</h2>
	</div>
</div>

<request-modal
	:id="{{ json_encode($event->id) }}"
	title="{{ $event->theme->title }}">
</request-modal>
<contact-publisher
	:company-id="{{ $event->theme->company->id }}"
	about="{{ $event->theme->title }}">
</contact-publisher>

<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
	<div class="container">
		<button
			class="navbar-toggler"
			type="button"
			data-toggle="collapse"
			data-target="#event-tools"
			aria-controls="event-tools"
			aria-expanded="false"
			aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="event-tools">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="#info" data-goto> Информация <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item d-none d-lg-block">
					<span class="nav-link mx-4">|</span>
				</li>
				<li class="nav-item">
					@if(!$event->teachers->isEmpty())
					<a class="nav-link" href="#teachers" data-goto> Лектори</a>
					@endif
				</li>
			</ul>

			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<button class="btn btn-outline-light btn-lg mr-2 my-1 my-1-sm" @click.prevent="callContactPublisher">Изпрати запитване</button>
				</li>
				<li class="nav-item">
					<button class="btn btn-light btn-lg my-1 my-1-sm" @click.prevent="callRequest">Заяви участие</button>
				</li>
			</ul>
		</div>
	</div>
</nav>

<div class="container mt-5" id="info">
	<div class="row">
		<div class="col-lg-8 col-md-12">
			<h3>{{ $event->theme->excerpt }}</h3>
			<p class="event-body">
				{{ $event->theme->body }}
			</p>

			@if(!$event->teachers->isEmpty())
			<section id="teachers">
				<h4>Лектори</h4>	
				@foreach($event->teachers as $teacher)
					<div class="card card-teacher bg-light mb-3">
						<div class="card-body d-flex align-content-stretch">
							<div>
								<img src="https://d3cwccg7mi8onu.cloudfront.net/72x72/{{ $teacher->image }}" class="rounded" alt="{{ $teacher->name }}">
							</div>
							<div class="content ml-3">
								<h5 class="card-title">{{ $teacher->name }}</h5>
								<p class="details">{{ $teacher->details }}</p>
								<div class="text-right">
									<button class="btn btn-link show-more">Прочети още..</button>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</section>
			@endif

			<section class="mt-5" id="comments">
				<h4>Коментари</h4>
				<comments
		    		auth="{{ Auth::check() }}"
		    		type="theme"
			    	id="{{ $event->theme->id }}"
			    	user_id="{{ auth()->id() }}">
			    </comments>
			</section>
		</div>
		<div class="col-lg-4 col-md-12">
			<div class="card bg-light mb-3">
				<div class="card-header">Допълнителна информация</div>
				<div class="card-body">
					<table class="table ">
						<tbody>
							<tr>
								<th scope="row"><i class="far fa-calendar"></i></th>
								<td>
									{{ $event->start_date_carbon }}
									@if($event->start_date_carbon != $event->end_date_carbon)
									 - {{ $event->end_date_carbon }}
									@endif
								</td>
							</tr>
							<tr>
								<th scope="row"><i class="fas fa-business-time"></i></th>
								<td>{{ $event->theme->duration }} учебни часа</td>
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
							<img
								src="https://d3cwccg7mi8onu.cloudfront.net/fit-in/72x72/{{ $event->theme->company->logo }}"
								class="rounded"
								alt="{{ $event->theme->company->name }}">
						</a>
						<h5 class="card-title">{{ $event->theme->company->name }}</h5>
					</div>
					<div class="text-center mt-4">
						<a href="/c/{{ $event->theme->company->slug }}" class="btn btn-primary">Фирмен профил</a>
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

@push('footer-scripts')
<script>
	$("[data-goto]").click(function(e) {
		e.preventDefault();
		
		var position = $($(this).attr("href")).offset().top -100;

		$("body, html").animate({
			scrollTop: position
		}, 500 /* speed */ );
	});

	$(document).ready(function(){
	    $(".show-more").click(function(){
	        $(this).parent().parent().find('p').toggle("slow");
	    });
	});
</script>
@endpush