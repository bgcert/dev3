@extends('layouts.app')

@section('title', $company->name)

@section('content')
<div class="company-header py-5">
	<div class="container">
		<div class="d-flex align-items-center">
			<img src="https://d3cwccg7mi8onu.cloudfront.net/fit-in/160x160/{{ $company->logo }}" alt="{{ $company->name }}" class="img-thumbnail">

			<h5 class="ml-3">{{ $company->name }}</h5>
		</div>

		<div class="info pt-5 mt-5">
			{{ $company->description }}
		</div>
	</div>
</div>

<div class="container">
	<div class="company">
		<header>
			<div class="add-links">
				<a href="/users/settings#/settings">+ Добави обучение |</a>
				<a href="/users/settings#/settings">+ Добави зала</a>
			</div>

			<div class="details">
				<div class="aligned">
					<div class="logo" style="background: url('https://d3cwccg7mi8onu.cloudfront.net/fit-in/160x160/{{ $company->logo }}'), #fff;">
					</div>
					<div class="title">
						{{ $company->name }}
					</div>
				</div>

				<div class="reg-box">
					<h3>
						Допълнителна информация за <strong>{{ $company->name }}</strong> можете да получите, като отправите запитване
					</h3>
					<contact-publisher
						button-text="Изпрати запитване"
						:company-id="{{ $company->id }}"
						about="{{ $company->name }}"
						btn-class="btn blue fluid">
					</contact-publisher>
				</div>
			</div>

			<div class="description">
				{{ $company->description }}
			</div>

			<section>
				<div class="indented">
					
				</div>
			</section>

			<!-- <div class="logo">
				<img src="https://d3cwccg7mi8onu.cloudfront.net/fit-in/100x100/{{ $company->logo }}">
			</div> -->
		</header>
		

		<section class="themes">
			<div class="title">Теми</div>
			<div class="grid grid-1-1">
				@foreach($themes as $theme)
					@include('partials.theme-box-alt', ['theme' => $theme])
				@endforeach
			</div>
		</section>

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
</div>
@endsection