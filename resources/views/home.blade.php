@extends('layouts.app')

@section('content')

<div class="jumbotron text-center">
	<h1 class="display-4">Семинари 365</h1>
	<h2>Открий курс днес. Бъди успешен утре.</h2>
	<hr>
	<search :large="true"></search>
</div>

<div class="container">
	<header>
		<div class="slider">
			<div class="add-links">
				<a href="users/settings#/settings">+ Добави обучение |</a>
				<a href="users/settings#/settings">+ Добави зала</a>
			</div>
			<div class="vcentered centered" style="margin: 0 auto; max-width: 66%;">
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
			<p>Seminari365.com е виртуална зона за модерните и динамичните хора, търсещи постоянно развитие. Seminari365.com e oнлайн платформа за курсове и семинари. Тук можете да откриете или да регистрирате Вашето успешно обучение.
			</p>
			<a href="/browse" class="inverted btn"> Всички курсове</a>
		</div>

		<div class="cat-list">
			<div class="grid grid-1-1-1">
				@foreach($categories as $category)
				<a href="/browse/{{ $category->slug }}" class="item cat">
					<i class="{{ $category->icon }}"></i>
					<div>{{ $category->name }}</div>
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