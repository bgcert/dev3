@extends('layouts.app')

@section('content')

    <div class="container my-4">
        <h4>{{ $exception->getMessage() }}</h4>
    </div>

@endsection