@extends('layouts.app')

@section('content')
<div class="container">
	<div class="ui grid">
		<div class="row">
			<div class="twelve wide column">
				<div class="cover" style="background: url({{ $venue->cover }}) center / cover no-repeat; height: 400px;">
					
				</div>
				<div class="ui small images">
					@foreach($images as $image)
					<img src="{{ $image->filename }}">
					@endforeach
				</div>
				<h4 class="ui dividing header">
					ПРЕПОРЪЧАНИ ЗАЛИ
				</h4>
				<div class="ui three column grid">
					<div class="column">
						<div class="item">
							<a class="ui small image">
								<img src="https://picsum.photos/600/400/?image=112">
							</a>
							<div class="content">
								<a class="header">Cute Dog</a>
								<div class="description">
									<p>Many people also have their own barometers for what makes a cute dog.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="column">
						<div class="item">
							<a class="ui small image">
								<img src="https://picsum.photos/600/400/?image=112">
							</a>
							<div class="content">
								<a class="header">Cute Dog</a>
								<div class="description">
									<p>Many people also have their own barometers for what makes a cute dog.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="column">
						<div class="item">
							<a class="ui small image">
								<img src="https://picsum.photos/600/400/?image=112">
							</a>
							<div class="content">
								<a class="header">Cute Dog</a>
								<div class="description">
									<p>Many people also have their own barometers for what makes a cute dog.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="four wide column">
				<h3 class="ui dividing header">
					ДЕТАЙЛИ ЗА ЗАЛАТА
				</h3>
				<table class="ui very basic table">
					<tbody>
						<tr>
							<td><b>Капацитет:</b></td>
							<td>100 места</td>
						</tr>
						<tr>
							<td><b> Кетеринг</b></td>
							<td>Предлага</td>
						</tr>
						<tr>
							<td><b> Мултимедия</b></td>
							<td>Предлага</td>
						</tr>
					</tbody>
				</table>
				<button class="big ui positive basic fluid button">
					Изпрати запитване
				</button>
			</div>
		</div>
	</div>
    <h2>{{ $venue->name }}</h2>
    <p>
    	{{ $venue->description }}
    </p>
    <p>
    	by <a href="/c/{{ $venue->company->slug }}">{{ $venue->company->name }}</a>
    </p>
    <h4>Comments</h4>
    <hr>
    @foreach($venue->comments as $comment)
    <div class="media">
    	<img class="mr-3" src="{{ $comment->user->picture }}" style="width: 28px;">
    	<div class="media-body">
    		<h5 class="mt-0"><a href="/user/{{ $comment->user->id }}">{{ $comment->user->name }}</a></h5>
    		<p>{{ $comment->body }}</p>	
    	</div>
    </div>   	
    @endforeach
</div>
@endsection