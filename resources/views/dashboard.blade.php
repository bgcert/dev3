@extends('layouts.app')

@push('header-scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.js"></script>
@endpush

<script>
    window.company = @json(auth()->user()->company);
</script>

@section('content')
	<div class="ui main container">
		@if(auth()->user()->role_id == 2)
		<dashboard></dashboard>	
		@else
		<div class="ui basic segment">
			<h4>Нямате достъп до този раздел</h4>
		</div>
		@endif
	</div>
@endsection