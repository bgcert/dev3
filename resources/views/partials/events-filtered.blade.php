<div class="form-inline d-flex justify-content-center my-4">
	<div class="form-group mr-3">
		<select class="form-control custom-select custom-select-lg" id="city" onchange="setUrlParam('city', this.value)">
			<option disabled selected value>Всички градове</option>
			@foreach($cities as $city)
			<option value="{{ $city->id }}">{{ $city->name }}</option>
			@endforeach
		</select>
	</div>

	<div class="form-group">
		<select class="form-control custom-select custom-select-lg" id="orderby" onchange="setUrlParam('orderby', this.value)">
			<option value="1" selected>Дата</option>
			<option value="2">Цена възх.</option>
		</select>
	</div>
</div>



<div class="row">
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
		if (city) $("#city").val(city);
		if (order) $("#orderby").val(order);
	});
</script>

@endpush