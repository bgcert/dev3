@extends('layouts.app')

@section('description', $company->name . ' - ' .  preg_replace('/[\n\r]/', ' ', str_limit($company->description, $words = 300, $end='...')))
@section('keywords', $company->name . ' - ' . $company->address)
@section('title', $company->name . ' | Seminari365.com')

@section('content')
<div class="company-header py-5">
	<div class="container">
		<div class="row d-flex align-items-center">
			<div class="col-lg-8 col-md-12 my-sm-4">
				<div class="d-flex align-items-center">
					<div class="logo">
						<img src="https://d3cwccg7mi8onu.cloudfront.net/fit-in/160x160/{{ $company->logo }}" alt="{{ $company->name }}">
					</div>

					<h5 class="ml-3">{{ $company->name }}</h5>
				</div>	
			</div>

			<div class="col">
				<div class="card trs text-white p-3">
					<p class="small mt-2">
						Допълнителна информация за <strong>{{ $company->name }}</strong> можете да получите, като отправите запитване
					</p>
					<button class="btn btn-outline-light mr-2 my-1 my-1-sm" @click.prevent="callContactPublisher">Изпрати запитване</button>
				</div>	
			</div>
		</div>
	</div>
</div>

<contact-publisher
	:company-id="{{ $company->id }}"
	about="{{ $company->name }}">
</contact-publisher>

<div class="container">
	<div class="row mt-4">
		<div class="col-lg-8 col-md-12">
			<p class="company-description">
				{{ $company->description }}	
			</p>
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
@endsection