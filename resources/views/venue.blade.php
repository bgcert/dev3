@extends('layouts.app')

@section('content')
<div class="container">
	<img src="{{ $venue->cover }}" style="height: 300px;">
    <h2>{{ $venue->name }}</h2>
    <p>
    	{{ $venue->description }}
    </p>
    <table>
    	<tr>
    		@foreach($images as $image)
    			<td><img src="{{ $image->filename }}" style="width: 200px;"></td>
    		@endforeach
  		</tr>
    </table>
    <p>
    	by <a href="/c/{{ $venue->company->slug }}">{{ $venue->company->name }}</a>
    </p>
</div>
@endsection