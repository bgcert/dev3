@extends('layouts.app')

@section('content')

<div
	class="venue-header d-flex align-items-center"
	style="background-image: url({{ 'https://d3cwccg7mi8onu.cloudfront.net/2000x700/' . $venue->cover }}), linear-gradient(rgba(4, 9, 30, 0.4), rgba(4, 9, 30, 0.6));">
	<div class="container">
		<dir class="row">
			<div class="col-8 details">
				<div class="venue-name">{{ $venue->name }}</div>
				<div class="location my-1">
					{{ $venue->city->name }}, {{ $venue->address }}
				</div>
				<div class="d-flex align-items-center">
					<img src="https://d3cwccg7mi8onu.cloudfront.net/fit-in/60x60/{{ $venue->company->logo }}" alt="{{ $venue->company->name }}" class="img-thumbnail">
					<h5 class="ml-3">{{ $venue->company->name }}</h5>
				</div>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb px-0 py-3">
						<li class="breadcrumb-item"><a href="/"> Начало</a></li>
						<li class="breadcrumb-item"><a href="/v"> Зали</a></li>
						<li class="breadcrumb-item active"> {{ $venue->name }}</li>
					</ol>
				</nav>
			</div>

			<div class="col-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Интересувате се от тази зала?</h5>
						<p class="card-text">Изпратете запитване към {{ $venue->company->name }}</p>
						<button class="btn btn-primary btn-block mr-2 my-1 my-1-sm" @click.prevent="callContactPublisher">Изпрати запитване</button>
					</div>
				</div>
			</div>
		</dir>
	</div>
</div>

<contact-publisher
	:company-id="{{ $venue->company->id }}"
	about="{{ $venue->name }}">
</contact-publisher>

<div class="venue container mt-4">
	<div class="row">
		<div class="col-8">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Галерия</h4>
					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

						<ol class="carousel-indicators">
							@foreach($images as $image)
								@if($loop->index == 0)
									<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
								@else
									<li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}"></li>
								@endif
							@endforeach
						</ol>

						<div class="carousel-inner">
							@foreach($images as $image)
								@if($loop->index == 0)
								<div class="carousel-item active">
									<img class="d-block w-100" src="https://d3cwccg7mi8onu.cloudfront.net/700x400/{{ $image }}">
								</div>
								@else
								<div class="carousel-item">
									<img class="d-block w-100" src="https://d3cwccg7mi8onu.cloudfront.net/700x400/{{ $image }}">
								</div>
								@endif
							@endforeach
						</div>
						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
			</div>

			<div class="card my-3">
				<div class="card-body">
					<h4 class="card-title">{{ $venue->name }}</h4>
					<p>{{ $venue->description }}</p>
				</div>
			</div>

			<comments
	    		auth="{{ Auth::check() }}"
	    		type="venue"
		    	id="{{ $venue->id }}"
		    	user_id="{{ auth()->id() }}">
		    </comments>
		</div>

		<div class="col-4">
			<div class="card">
				<div class="card-body text-center">
					<h4>{{ $venue->company->name }}</h4>	
					<img src="https://d3cwccg7mi8onu.cloudfront.net/fit-in/160x160/{{ $venue->company->logo }}">
					<a href="/c/{{ $venue->company->slug }}" class="btn btn-warning mt-3">Фирмен профил</a>
				</div>
			</div>

			<div class="card bg-light my-3">
				<div class="card-body">
					<h5 class="card-title">Детайли</h5>
					<!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
					<table class="table">
						<tbody>
							<tr>
								<th scope="row">Капацитет</th>
								<td>{{ $venue->capacity }}</td>
							</tr>
							<tr>
								<th scope="row">Адрес</th>
								<td>{{ $venue->city->name }}, {{ $venue->address }} места</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<div>
		<h4>Популярни обучения</h4>
		<related-feed
			auth="{{ auth()->check() }}"
			company_id="{{ $venue->company->id }}">
		</related-feed>
	</div>
</div>
@endsection