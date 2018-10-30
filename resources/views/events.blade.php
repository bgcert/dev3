@extends('layouts.app')

@section('content')

	<div class="container">
		browse
		<div>
			<select id="city" onchange="setUrlParam('city', this.value)">
				<option disabled selected value>Всички градове</option>
				@foreach($cities as $city)
				<option value="{{ $city->id }}">{{ $city->name }}</option>
				@endforeach
			</select>
		</div>

		<div>
			<select id="orderby" onchange="setUrlParam('orderby', this.value)">
				<option value="1" selected>Дата</option>
				<option value="2">Цена възх.</option>
				<option value="3">Най-популярни</option>
				<option value="4">Най-популярни.</option>
			</select>
		</div>

		<div class="grid indented">
			@foreach($categories as $category)
				<a 
					class="cat-box" style="background: url('https://placeimg.com/640/480/any?i={{ $category->id  }}'), rgba(0,0,0,.56);"
					href="/browse/{{ $category->slug }}">
					{{ $category->name }}
				</a>
			@endforeach
		</div>

		<div class="grid indented">
			@foreach($events as $event)
				@include('partials.event-box', ['event', $event])
			@endforeach
		</div>
	</div>
    <!-- <event-feed
		auth="{{ auth()->check() }}"
		slug="{{ Request::route('slug') }}">
	</event-feed> -->

@endsection

@push('footer-scripts')

<script>
	function getUrlParam(param) {
		const params = new URLSearchParams(location.search);
		return params.get(param);
	}

	function setUrlParam(param, value) {
		const params = new URLSearchParams(location.search);
		params.set(param, value);
		window.location = location.pathname + '?' + params;
		//window.history.replaceState({}, '', `${location.pathname}?${params}`);
	}

	$(document).ready(function () {
		let city = getUrlParam('city');
		let order = getUrlParam('orderby');
		$("#city").val(city);
		$("#orderby").val(order);
	});
</script>

@endpush