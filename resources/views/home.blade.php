@extends('layouts.app')

@section('content')

@push('header-scripts')
    <style>
		.category-box {
			display: flex;
			border-radius: 3px;
			align-items: center;
			justify-content: center;
			height: 150px;
			color: white;
		}
	</style>
@endpush

<carousel></carousel>

<div class="ui hidden divider"></div>

<div class="ui container mt-20">
	<div class="ui equal width center aligned divided grid">
		<div class="column">
			<div class="ui purple inverted segment">
				<h2>Публикувайте обучение</h2>
				<p>Добавете Вашите актуални обучение в Семинари 365</p>
				<a class="ui large basic inverted button" href="/register">Регистрация</a>
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
</div>

<div class="ui hidden divider"></div>
<event-feed></event-feed>

<div class="ui container mt-20">

	
	
</div>
@endsection