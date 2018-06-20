@extends('layouts.app')

@section('content')
<div class="sub-nav" style="background-color: #fff; padding: 10px; border-bottom: 1px solid #DDDDDD;">
	<div class="ui container">
		<div class="ui breadcrumb">
			<a href="/" class="section">Начало</a>
			<i class="right angle icon divider"></i>
			<div class="active section">{{ $company->name }}</div>
		</div>
	</div>
</div>

<div class="ui container">
	<company-view
		slug="{{ $company->slug }}"
		>
	</company-view>
</div>
@endsection