@extends('layouts.app')

@section('content')
<div class="ui container">
	<company-view
		slug="{{ $company->slug }}"
		>
	</company-view>
</div>
@endsection