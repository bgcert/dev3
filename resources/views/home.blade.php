@extends('layouts.app')

@section('content')

<div class="jumbotron m-0 text-center">
	<div class="d-lg-flex justify-content-end mb-5">
		<a href="users/settings#/settings" class="text-white mx-2">+ Добави обучение |</a>
		<a href="users/settings#/settings" class="text-white mx-2">+ Добави зала</a>
	</div>
	<div class="container">

		<h1 class="display-4">Семинари 365</h1>
		<h2>Открий курс днес. Бъди успешен утре.</h2>

		<div class="row justify-content-center">
			<div class="col-12 col-lg-6 col-md-8">
				<search :cls="'search-input lg'"></search>
			</div>
		</div>
	</div>
	
</div>

<section class="categories">
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-lg-6 col-md-12 m-0 p-0">
				<div class="info">
					<div class="p-4">
						<h2 class="mb-4">
							Богата селекция от курсове и програми на водещи обучаващи организации
						</h2>
						<h5>
							Seminari365.com е виртуална зона за модерните и динамичните хора, търсещи постоянно развитие. Seminari365.com e oнлайн платформа за курсове и семинари. Тук можете да откриете или да регистрирате Вашето успешно обучение.
						</h5>
						<a href="/browse" class="btn btn-outline-light btn-lg mt-5">
							Всички курсове
						</a>
					</div>
				</div>
			</div>

			<div class="col-lg-6 col-md-12 m-0 p-0">
				<div class="cat-list">
					<div class="row">
						@foreach($categories as $category)
						<div class="col-lg-4 col-md-6 col-sm-12">
							<a href="/browse/{{ $category->slug }}" class="cat d-flex align-items-center m-3">
								<i class="{{ $category->icon }}"></i>
								<div>{{ $category->name }}</div>
							</a>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	
</section>

<section class="mb-4">
	<div class="segment announce text-center p-4">
		<h1 class="my-4">
			Желаете да публикувате в Семинари 365?
		</h1>
		<a href="/page/publish" class="btn btn-dark btn-lg m-4">Вижте как</a>
	</div>
</section>

<div class="container my-5">

	<h4>Актуални обучения</h4>

	@include('partials.events-filtered', ['cities' => $cities, 'events' => $events])
	
</div>
@endsection