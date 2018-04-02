@extends('layouts.app')

@section('content')
<div class="container">
	<company-view
		slug="{{ $company->slug }}"
		>
	</company-view>
</div>
@endsection