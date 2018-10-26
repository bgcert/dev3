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
		<div class="themes indented">
			<div class="title">Теми</div>
			<div class="grid grid-1-1">
				@foreach($themes as $theme)
					@include('partials.theme-box-alt', ['theme' => $theme])
				@endforeach
			</div>
		</div>

		<div class="events indented">
			<div class="title">График на предстоящите обучения</div>
			@foreach($events as $event)
				<div class="month"></div>
				<li>{{ $event->theme->title }} - {{ $event->month_carbon }}</li>
			@endforeach
		</div>
	</div>
</div>

<hr>
<div class="sub-nav" style="background-color: #fff; padding: 10px; border-bottom: 1px solid #DDDDDD;">
	<div class="ui container">
		<div class="ui breadcrumb">
			<a href="/" class="section">Начало</a>
			<i class="right angle icon divider"></i>
			<div class="active section">{{ $company->name }}</div>
		</div>
	</div>
</div>

<div class="ui container">
	<!-- <company-view slug="{{ $company->slug }}"></company-view> -->
</div>
@endsection