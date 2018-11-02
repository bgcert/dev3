@extends('layouts.app')

@section('content')

<div class="container">
	<header>
		<div class="slider">
			<div class="add-links">
				<a href="#">+ Добави обучение |</a>
				<a href="#">+ Добави зала</a>
			</div>
			<div class="vcentered" style="margin: 0 auto; max-width: 66%;">
				<div class="h1 inverted shadow-text">
					Семинари 365
				</div>
				<div class="h2 inverted shadow-text">
					Открий курс днес. Бъди успешен утре.
				</div>
				<search :large="true"></search>
			</div>
		</div>	
	</header>

	<section class="categories">
		<div class="cat-info inverted">
			<div class="h3">Богата селекция от курсове и програми на водещи обучаващи организации</div>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco.</p>
			<a href="/browse" class="inverted btn"> Всички курсове</a>
		</div>

		<div class="cat-list">
			<div class="grid" style="grid-template-columns: 1fr 1fr 1fr;">
				@foreach($categories as $category)
				<a href="/browse/{{ $category->slug }}" class="item cat">
					<div class="aligned">
						<i class="fas fa-user-tie"></i>
						<div class="h5">{{ $category->name }}</div>
					</div>
				</a>
				@endforeach
			</div>
		</div>
	</section>

	<section class="announce centered">
			<div class="inverted shadow-text h4">
				Желаете да публикувате в Семинари 365?
			</div>
			<a href="/page/publish" class="btn grey">
				Вижте как
			</a>
	</section>

	<section class="content">
		<div class="container indented">
			<div class="section-title">
				Актуални обучения
			</div>
			@include('partials.events-filtered', ['cities' => $cities, 'events' => $events])
		</div>
	</section>
	
</div>
@endsection