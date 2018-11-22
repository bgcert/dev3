@extends('layouts.app')

@section('content')

<div class="container">
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
					<img class="d-block w-100" src="https://d3cwccg7mi8onu.cloudfront.net/1000x300/{{ $image }}">
				</div>
				@else
				<div class="carousel-item">
					<img class="d-block w-100" src="https://d3cwccg7mi8onu.cloudfront.net/1000x300/{{ $image }}">
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

	<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
		<div class="container">
			<button
				class="navbar-toggler"
				type="button"
				data-toggle="collapse"
				data-target="#navbarColor02"
				aria-controls="navbarColor02"
				aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarColor02">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item text-white">
						<i class="fas fa-map-marker-alt"></i>
						{{ $venue->city->name }}, {{ $venue->address }}
					</li>
				</ul>

				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<contact-publisher
							button-text="Изпрати запитване"
							:company-id="{{ $venue->company->id }}"
							about="{{ $venue->name }}"
							btn-class="btn btn-outline-light btn-lg mr-2 my-1 my-1-sm">
						</contact-publisher>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="row mt-4">
		<div class="col-8">
			<h2>{{ $venue->name }}</h2>

			<p>{{ $venue->description }}</p>

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
					<h3>{{ $venue->company->name }}</h3>	
					<img src="https://d3cwccg7mi8onu.cloudfront.net/fit-in/250x250/{{ $venue->company->logo }}">
					<a href="/c/{{ $venue->company->slug }}" class="btn btn-primary btn-lg btn-block mt-3">Фирмен профил</a>
				</div>
			</div>
		</div>
	</div>

	<div class="venue">
		
		<div class="grid grid-5-2 mtop indented">
			<div>
				<div>
					<table>
				    	<tbody>
				    		<tr>
				    			<td>Капацитет</td>
				    			<td>{{ $venue->capacity }} места</td>
				    		</tr>
				    		<tr>
				    			<td>Адрес</td>
				    			<td>{{ $venue->city->name }}, {{ $venue->address }}</td>
				    		</tr>
				    	</tbody>
				    </table>
				</div>
			</div>
			<div>
				<div>
					@if($venue->company->phone != '')
					<p>
						<a
							id="number"
							class="btn blue fluid"
							data-number="{{$venue->company->phone}}">
							<i class="mobile alternate icon"></i>
							<span>
								{{ str_limit($venue->company->phone, 2, str_repeat("X", strlen($venue->company->phone) - 2)) }}
							</span>
						</a>
					</p>
					@endif
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