@extends('layouts.app')

@section('content')
<div class="container">
	<div class="company">
		<header>
			<div class="add-links">
				<a href="#">+ Добави обучение |</a>
				<a href="#">+ Добави зала</a>
			</div>

			<div class="info">
				<div>
					<div class="logo">
						<img src="https://d3cwccg7mi8onu.cloudfront.net/fit-in/100x100/{{ $company->logo }}">
					</div>
					{{ $company->name }}
				</div>
				<div>
					{{ $company->description }}
				</div>
			</div>
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
							<img src="https://d3cwccg7mi8onu.cloudfront.net/fit-in/100x100/{{ $item->cover }}">
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