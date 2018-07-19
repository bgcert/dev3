@extends('layouts.app')

@section('content')
    <div class="ui container">
    	<h2>{{ \Auth::user()->company->name }}'s dashboard</h2>
    	<div class="row">
    		<div class="col-2">
    			<nav class="nav flex-column">
				  <a class="nav-link active" href="/dashboard">{{ \Auth::user()->company->name }}</a>
				  <a class="nav-link" href="/dashboard/themes">Themes</a>
				  <a class="nav-link" href="/dashboard/events">Events</a>
				  <a class="nav-link disabled" href="/dashboard/teachers">Teachers</a>
				  <a class="nav-link" href="/dashboard/venues">Venues</a>
				  <a class="nav-link" href="/dashboard/orders">Orders</a>
				  <a class="nav-link" href="/dashboard/comments">Comments</a>
				</nav>
    		</div>
    		<div class="col-10">
    			@yield('secondary-content')
    		</div>
    	</div>
    </div>

@endsection