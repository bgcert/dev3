@extends('layouts.app')

@section('content')

<div class="container">
	<header>
		<div class="slider">
			<div class="add-links">
				<a href="#">+ Добави обучение |</a>
				<a href="#">+ Добави зала</a>
			</div>
			<div class="search-container centered">
				<div class="h1 inverted shadow-text">
					Семинари 365
				</div>
				<div class="h2 inverted shadow-text">
					Открий курс днес. Бъди успешен утре.
				</div>
				<div>
					<div class="search-large">
						<input type="text" name="search">
					</div>
				</div>
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
						<i class="material-icons">trending_up</i>
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
		<div class="container small">
			<div class="section-title">
				Актуални обучения
			</div>
			@include('layouts.includes.event-feed')
		</div>
	</section>

	
</div>



<!-- <carousel></carousel> -->

<!-- <div class="ui hidden divider"></div>

<div class="ui container mt-20">
	<div class="ui equal width center aligned divided grid">
		<div class="column">
			<div class="ui purple inverted segment">
				<h2>Публикувайте обучение</h2>
				<p>Добавете Вашите актуални обучение в Семинари 365</p>
				@if(auth()->check())
					@if(auth()->user()->role_id == 2)
					<a class="ui large basic inverted button" href="/dashboard#/events">Календар</a>
					@else
					<a class="ui large basic inverted button" href="/users/settings#/settings">Бизнес акаунт</a>
					@endif
				@else
				<a class="ui large basic inverted button" href="/register">Регистрация</a>
				@endif
			</div>
		</div>
		<div class="column">
			<div class="ui orange inverted segment">
				<h2>Зали и конферентни центрове</h2>
				<p>Открийте подходящата зала за Вашето събитие</p>
				<a class="ui large basic inverted button" href="/v">Зали</a>
			</div>
		</div>
	</div>
</div> -->

<!-- <div class="ui hidden divider"></div> -->
<!-- <event-feed></event-feed> -->

<!-- <div class="ui container mt-20">
	<div class="ui placeholder segment">
		<div class="ui icon header">
			<i class="question icon"></i>
			Желаете да публикувате в Семинари365?
		</div>
		<a href="/page/publish" class="ui primary button">Вижте как</a>
	</div>
</div> -->

<!-- <div class="ui container mt-20">
	@include('layouts.includes.event-feed')
</div> -->

<!-- <div class="ui container mt-20">
	
</div> -->
@endsection