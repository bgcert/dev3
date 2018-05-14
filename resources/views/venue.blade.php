@extends('layouts.app')

@push('header-scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/locale/bg.js"></script>
@endpush

@section('content')
<div class="sub-nav" style="background-color: #fff; padding: 10px; border-bottom: 1px solid #DDDDDD;">
	<div class="ui container">
		<div class="ui breadcrumb">
			<a href="/" class="section">Начало</a>
			<i class="right angle icon divider"></i>
			<a href="/v" class="section">Зали</a>
			<i class="right angle icon divider"></i>
			<a href="/c/{{ $venue->company->slug }}" class="section">{{ $venue->company->name }}</a>
			<i class="right angle icon divider"></i>
			<div class="active section">{{ $venue->name }}</div>
		</div>
	</div>
</div>

<div class="ui container">
	<div class="ui grid">
		<div class="row">
			<div class="twelve wide column">
				<div class="row">
					<div class="column">
						<venue-slider
							id="{{ $venue->id }}"
							cover="{{ $venue->cover }}"
							>
						</venue-slider>
					</div>
				</div>				
				<div class="row">
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

				<div class="row">
					<h2>{{ $venue->name }}</h2>
				    <p>
				    	{{ $venue->description }}
				    </p>
				    <p>
				    	by <a href="/c/{{ $venue->company->slug }}">{{ $venue->company->name }}</a>
				    </p>
				</div>
				
				<div class="row">
					<div id="comments">
				    	<comments
				    		auth="{{ Auth::check() }}"
				    		type="venue"
					    	id="{{ $venue->id }}"
					    	user_id="{{ auth()->id() }}"
					    	>
					    </comments>
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
				<button class="large ui positive basic fluid button">
					Изпрати запитване
				</button>
				<div>
					<a href="#"><i class="flag icon"></i> Докладвай</a>
				</div>
			</div>
		</div>
	</div>
    
    
</div>
@endsection