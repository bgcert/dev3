@extends('layouts.app')

@section('content')

@push('header-scripts')
    <style>
    	#nav-header {
    		position: absolute;
    		top: 0;
    		left: 0;
    		right: 0;
    		margin: 0 auto;
    		z-index: 10;
    		background-color: transparent;
    		border: none;
    		box-shadow: none;
    	}

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
<div class="ui container">
	
	<div class="ui center aligned grid">
		<div class="column">
			<h3 class="ui header">
				Seminari365 is growing fast. Want to see just how much? Sign up and we'll let you know
			</h3>
		</div>
	</div>

	<div class="ui hidden divider"></div>

	<div id="search"></div>

	<event-feed></event-feed>
	
</div>
@endsection