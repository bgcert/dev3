@extends('layouts.users')

@section('secondary-content')
	
	<h2>settings</h2>

	<div class="ui centered grid">
		<div class="twelve wide column">
			<settings
				id="{{ Auth::id() }}"
				>
			</settings>
		</div>
	</div>

@endsection