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

<div class="ui container segment mt-20">
	<div class="ui equal width center aligned divided grid">
		<div class="column">
			<h1>Публикувайте курс</h1>
			<p>test test </p>
			<a class="ui large button" href="#">Регистрация</a>
		</div>
		<div class="column">
			<h1>Открийте подходящата зала </h1>
			<p>test test </p>
			<a class="ui large button" href="#">Зали</a>
		</div>
	</div>
</div>

<div class="ui hidden divider"></div>
<event-feed></event-feed>

<div class="ui container mt-20">

	
	
</div>
@endsection