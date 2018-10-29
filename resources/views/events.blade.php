@extends('layouts.app')

@section('content')

	<div class="container">
		browse
		<div>
			<select id="city-select" onchange="setUrlParam(this, 'city');">
				<!-- <option value="" selected>Всички градове</option> -->
				@foreach($cities as $city)
				<option value="{{ $city->id }}">{{ $city->name }}</option>
				@endforeach
			</select>
		</div>

		<div>
			<select id="sortby" onchange="setUrlParam(this, 'sortby');">
				<option value="1">Цена възх.</option>
				<option value="2">Най-популярни</option>
				<option value="3">Най-популярни.</option>
			</select>
		</div>

		<div class="cat">
			@foreach($categories as $category)
				<li><a href="/browse/{{ $category->slug }}">{{ $category->name }}</a></li>
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
	function setUrlParam(item, param) {
		let params = (new URL(document.location)).searchParams;
		let currentValue = params.get(param);

		if (currentValue == null) {
			let urlParam = jQuery.param({ [param]: item.value });
			window.location.search += urlParam;
		} else {
			window.location = location.href.replace(param + "=" + currentValue, param + "=" + item.value);
		}
	}

	function getUrlParamValue(param) {
		return (new URL(document.location)).searchParams.get(param);
	}

	$(function(){
		let city = getUrlParamValue('city');
		$('#city-select').val(getUrlParamValue('city'));
		$('#sortby').val(getUrlParamValue('sortby'));
		// bind change event to select
		// $('#city-select').on('change', function () {
		// 	let params = (new URL(document.location)).searchParams;
		// 	let city = params.get("city");

		// 	if (city == null) {
		// 		city = jQuery.param({ city:$(this).val() });
		// 		window.location.search += city;
		// 	} else {
		// 		window.location = location.href.replace("city=" + city, "city=" + $(this).val());
		// 	}
		// });

		// $('#order-select').on('change', function () {
		// 	let params = (new URL(document.location)).searchParams;
		// 	let order = params.get("order");

		// 	if (order) {
		// 		var newUrl = location.href.replace("order=" + order, "order=" + $(this).val());
		// 		window.location = newUrl; // redirect
		// 	}
		// });
	});
</script>
@endpush