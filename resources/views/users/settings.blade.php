@extends('layouts.app')

@section('content')

	<div class="ui centered grid">
		<div class="twelve wide column">
			<settings
				id="{{ Auth::id() }}"
				>
			</settings>
		</div>
	</div>

@endsection