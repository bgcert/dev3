@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $company->name }}'s dashboard</h2>
    <hr>
    @include('includes.dash-nav')
</div>
@endsection