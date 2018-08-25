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
<div class="ui container mt-20">

	<div class="ui hidden divider"></div>

	<event-feed></event-feed>
	
</div>
@endsection