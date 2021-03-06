@extends('layouts.app')

@section('description', 'Seminari365.com - Излъчвайте събитията си на живо. Професионален видео стрийминг на събития. Техническо съдействие при настройване на техниката, софтуера и стартиране на излъчването.')
@section('keywords', 'Видео стрийминг, Професионален видео стрийминг, стрийминг на живо, стрийминг на събития, излъчване на живо, видео излъчване')
@section('title', 'Професионален видео стрийминг на събития')


@section('content')

<div class="live-streaming-header d-flex justify-content-center align-items-center">
	<h1 class="text-white">Излъчвайте събитията си на живо</h1>
</div>

<div class="container">
	<div class="text-center">
		<h3 class="mt-4">Професионален видео стрийминг на събития</h3>

		<p class="my-4">
			Организирате курс или семинар? Достигнете до Вашата аудитория навсякъде!
			Излъчвайте към клиенти по целия свят чрез Seminari365.com. 
			Продавайте Вашите събития без ограничения!
		</p>

		<div class="card-deck">
			<div class="card border-success">
				<div class="card-header bg-success text-white">
					<h3>Старт 10</h3>
				</div>
				<div class="card-body">
					<h1 class="card-title">
						80
						<small>лв./ден</small>
					</h1>
					<ul class="list-group list-group-flush mt-4">
						<li class="list-group-item">До 10 online участника</li>
						<li class="list-group-item">Контрол на достъпа до излъчването</li>
						<li class="list-group-item">* Видео запис</li>
						<li class="list-group-item">Техническо съдействие при настройване на техниката, софтуера и стартиране на излъчването</li>
					</ul>
					<p class="card-text"><small class="text-muted">* Излъчването се записва при предварително заявяване. Услугата е ВКЛЮЧЕНА в цената. Цената е с включен ДДС.</small></p>
				</div>
				<div class="card-footer">
					<a href="#" class="btn btn-success btn-lg btn-block" @click.prevent="callContactAdmin('Streaming - start 10')">Запитване</a>
				</div>
			</div>

			<div class="card border-warning">
				<div class="card-header bg-warning">
					<h3>Про 20</h3>
				</div>
				<div class="card-body">
					<h1 class="card-title">
						120 
						<small>лв./ден</small>
					</h1>
					<ul class="list-group list-group-flush mt-4">
						<li class="list-group-item">До 20 online участника</li>
						<li class="list-group-item">Контрол на достъпа до излъчването</li>
						<li class="list-group-item">* Видео запис</li>
						<li class="list-group-item">Техническо съдействие при настройване на техниката, софтуера и стартиране на излъчването</li>
					</ul>
					<p class="card-text"><small class="text-muted">* Излъчването се записва при предварително заявяване. Услугата е ВКЛЮЧЕНА в цената. Цената е с включен ДДС.</small></p>
				</div>
				<div class="card-footer">
					<a href="#" class="btn btn-warning btn-lg btn-block" @click.prevent="callContactAdmin('Streaming - pro 20')">Запитване</a>
				</div>
			</div>

			<div class="card border-primary">
				<div class="card-header bg-primary text-white">
					<h3>Бизнес</h3>
				</div>
				<div class="card-body">
					<h4 class="card-title">
						Цена при запитване
					</h4>
					<ul class="list-group list-group-flush mt-4">
						<li class="list-group-item">Неограничен брой участници</li>
						<li class="list-group-item">Контрол на достъпа до излъчването</li>
						<li class="list-group-item">Видео запис</li>
						<li class="list-group-item">Транскодиране с различно качество</li>
						<li class="list-group-item">Техническо съдействие при настройване на техниката, софтуера и стартиране на излъчването</li>
					</ul>
					<!-- <p class="card-text"><small class="text-muted">* Излъчването се записва с предварителна заявка. Услугата е ВКЛЮЧЕНА в цената.</small></p> -->
				</div>
				<div class="card-footer">
					<a href="#" class="btn btn-primary btn-lg btn-block" @click.prevent="callContactAdmin('Streaming - bussiness')">Запитване</a>
				</div>
			</div>
		</div>

		<contact-admin></contact-admin>

		<h4 class="mt-4">
			Ние гарантираме излъчване с най-високо качество от всяка точка на света.
		</h4>

		<p>
			ИЗПРАТЕТЕ ЗАПИТВАНЕ ИЛИ СЕ ОБАДЕТЕ НА 02/ 4032404
		</p>
	</div>
</div>

@endsection