@extends('layouts.app')

@section('title', $company->name)

@section('content')
<div class="company-header py-5">
	<div class="container">
		<div class="row d-flex align-items-center">
			<div class="col-lg-8 col-md-12 my-sm-4">
				<div class="d-flex align-items-center">
					<img src="https://d3cwccg7mi8onu.cloudfront.net/fit-in/160x160/{{ $company->logo }}" alt="{{ $company->name }}" class="img-thumbnail">

					<h5 class="ml-3">{{ $company->name }}</h5>
				</div>	
			</div>

			<div class="col">
				<div class="card trs text-white p-3">
					<p class="small mt-2">
						Допълнителна информация за <strong>{{ $company->name }}</strong> можете да получите, като отправите запитване
					</p>
					<contact-publisher
						button-text="Изпрати запитване"
						:company-id="{{ $company->id }}"
						about="{{ $company->name }}"
						btn-class="btn btn-primary btn-block">
					</contact-publisher>
				</div>	
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row mt-4">
		<div class="col-lg-8 col-md-12">
			{{ $company->description }}	
		</div>
		<div class="col-lg-4 col-md-12">
			<div class="card">
				<div class="card-body">
					<ul class="list-group list-group-flush">
						<li class="list-group-item">{{ $company->name }}</li>
						<li class="list-group-item">{{ $company->phone }}</li>
						<li class="list-group-item">{{ $company->email }}</li>
						<li class="list-group-item">{{ $company->address }}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	@if(!$themes->isEmpty())
	<div class="row mt-4">
		@foreach($themes as $theme)
			<div class="col-lg-6 col-md-12 pb-3">
				@include('partials.theme-box-alt', ['theme' => $theme])
			</div>
		@endforeach
	</div>
	@endif

	@if(!$events->isEmpty())
		<hr class="my-5">
		<h4>График на предстоящите обучения</h4>

		<table class="table table-hover event-list-table mt-4">
		@foreach($events as $month => $items)
			<thead>
				<tr>
					<th scope="col" colspan="3">{{ $month }}</th>
				</tr>
			</thead>

			<tbody>
			@foreach($items as $item)
				<tr class="tr-link" onclick="window.location='/event/{{ $item->id }}';">
					<th scope="row">{{ $item->start_day_carbon }}</th>
					<td>
						<img class="mx-auto d-block" src="https://d3cwccg7mi8onu.cloudfront.net/100x56/{{ $item->cover }}">
					</td>
					<td>
						{{ $item->theme->title }}
					</td>
				</tr>
			@endforeach
			</tbody>
		@endforeach
		</table>
	@endif
</div>

<!-- <div class="container">
	<div class="company">


		<section class="events indented">
			<div class="title">График на предстоящите обучения</div>

			@foreach($events as $month => $items)
				<div class="month">
					{{ $month }}
				</div>
				@foreach($items as $item)
				<a href="/event/{{ $item->id }}" class="item">
					<div class="date">
						{{ $item->start_day_carbon }}
					</div>
					<div class="info">
						<div class="cover">
							<img src="https://d3cwccg7mi8onu.cloudfront.net/100x56/{{ $item->cover }}">
						</div>
						<div class="title">
							{{ $item->theme->title }}
						</div>
					</div>
				</a>
				@endforeach
			@endforeach
		</section>
	</div>
</div> -->
@endsection