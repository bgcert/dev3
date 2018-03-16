@extends('layouts.app')

@section('content')
    
    <div class="container">
    	<h2>{{ \Auth::user()->name }}'s settings</h2>
    	<ul class="nav nav-tabs">
    		<li class="nav-item">
    			<a class="nav-link active" href="#">Activity</a>
    		</li>
    		<li class="nav-item">
    			<a class="nav-link" href="#">Link</a>
    		</li>
    		<li class="nav-item">
    			<a class="nav-link" href="#">Link</a>
    		</li>
    		<li class="nav-item">
    			<a class="nav-link disabled" href="#">Disabled</a>
    		</li>
    	</ul>
    	<hr>
    	@yield('secondary-content')
    </div>

@endsection