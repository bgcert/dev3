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
	</select>
</div>

<div class="grid">
	@foreach($events as $event)
		@include('partials.event-box', ['event', $event])
	@endforeach
</div>

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