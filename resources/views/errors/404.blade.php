@extends('layouts.app')

@section('content')

    <div class="container my-4">
        @if($exception->getMessage())
        <h4>{{ $exception->getMessage() }}</h4>
        @else
        <h4>Страницата не е намерена</h4>
        @endif
    </div>

@endsection