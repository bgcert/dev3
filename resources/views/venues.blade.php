@extends('layouts.app')

@section('content')
<div class="container">
    <h2>venues</h2>
    <table class="table table-bordered">
    @foreach($venues as $v)
    
    	<tr>
			<td>#ID</td>
			<td>{{ $v->id }}</td>
			
		</tr>
		<tr>
			<td>Name</td>
			<td><a href="/venue/{{ $v->id }}">{{ $v->name }}</a></td>
			
		</tr>
		<tr>
			<td>cover</td>
			<td><img src="{{ $v->cover }}" style="width: 200px;"></td>
		</tr>
		<tr>
			<td>Organization</td>
			<td><a href="/c/{{ $v->company->slug }}">{{ $v->company->name }}</a></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<like
					likes="{{ $v->likes_count }}"
					liked="{{ $v->isLiked->count() }}"
					item_id="{{ $v->id }}"
					route="/users/like/venue"
					>
				</like>
			</td>
		</tr>
		<tr>
			<td colspan="2"></td>
		</tr>
	
    @endforeach
    </table>
</div>
@endsection