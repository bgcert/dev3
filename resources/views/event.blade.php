@extends('layouts.app')

@push('header-scripts')
	<style>
		.cover {
			background-color: #505763;
			background-size: cover;
    		background-position: 50%;
		}
		.overlay {
			height: 100%;
			background-color: rgba(0,0,0,0.6);
		}
		.flex-center {
			 display: flex !important;
			 justify-content:center;
			 align-items: center;
		}
		.info { color: white; }
		.details { border: 1px solid red; flex: 1; }
		.flex { display: flex; }
		.logo { flex: 1; }
		.company-details { flex: 3; text-align: center; }
		.event-header { padding: 30px 0 !important; }
	</style>
@endpush

@section('content')
<div class="cover" style="background-image: url({{ 'https://d3cwccg7mi8onu.cloudfront.net/fit-in/2000x400/' . $event->cover }});">
	<div class="overlay">
		<div class="ui container">
			<div class="ui basic segment">
				<div class="ui breadcrumb inverted-breadcrumb">
					<a href="/" class="section">Начало</a>
					<i class="right angle icon divider"></i>
					<a href="/browse" class="section">Обучения</a>
					<i class="right angle icon divider"></i>
					<div class="active section">{{ $event->theme->title }} - {{ $event->start_date_carbon }}</div>
				</div>
			</div>
			<div class="ui grid event-header">
				<div class="flex-center ten wide column ">
					<div class="info">
						<h1 class="title">{{ $event->theme->title }}</h1>
						<p>{{ $event->theme->excerpt }}</p>
						<h3>{{ $event->start_date_carbon }} - {{ $event->end_date_carbon }}</h3>
					</div>	
				</div>
				<div class="six wide column">
					<div class="ui segment">
						<div class="flex">
							<div class="logo">
								<a href="/c/{{ $event->theme->company->slug }}">
									<img class="ui tiny image" src="http://image-store.seminari365.com/100x100/{{ $event->theme->company->logo }}">
								</a>
							</div>
							<div class="company-details">
								<h3>{{ $event->theme->company->name }}</h3>
								<a href="/c/{{ $event->theme->company->slug }}" class="ui basic button">Фирмен профил</a>
							</div>
						</div>
						<div class="ui divider"></div>
						<div>
							<div class="ui list">
								<div class="item">
									<i class="map marker alternate icon"></i>
									<div class="content">
										{{ $event->city->name }}, {{ $event->address }}
									</div>
								</div>
								<div class="item">
									<i class="calendar outline icon"></i>
									<div class="content">
										{{ $event->start_date_carbon }} - {{ $event->end_date_carbon }}
									</div>
								</div>
								<div class="item">
									<i class="redo alternate icon"></i>
									<div class="content">
										{{ $event->theme->duration }} учебни часа
									</div>
								</div>
							</div>
						</div>
						<div class="ui horizontal statistics">
							<div class="statistic">
								<div class="value">{{ $event->price }}.00</div>
								<div class="label">лв. с ДДС</div>
							</div>
							<request-modal style="width: 100%;"
								:id="{{ json_encode($event->id) }}"
								title="{{ $event->theme->title }}"
								:auth="{{ json_encode(Auth::check()) }}"
								classes="ui fluid orange button">
							</request-modal>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="ui container mt-20">
	
	<div class="ui segment padded grid">

		<div class="two column row">
			<div class="ten wide column">
				<p>
			    	{{ $event->theme->body }}
			    </p>

			    <table class="ui celled padded table">
			    	<tbody>
			    		<tr>
			    			<td>Дати на провеждане</td>
			    			<td>{{ $event->start_date_carbon }} - {{ $event->end_date_carbon }}</td>
			    		</tr>
			    		<tr>
			    			<td>Начален час / Краен час</td>
			    			<td>{{ $event->start_at_carbon }} / {{ $event->end_at_carbon }} ч.</td>
			    		</tr>
			    		<tr>
			    			<td>Място</td>
			    			<td>{{ $event->city->name }}, {{ $event->address }}</td>
			    		</tr>
			    		<tr>
			    			<td>Цена</td>
			    			<td>{{ $event->price }}.00 лв. с включен ДДС</td>
			    		</tr>
			    		<!-- <tr>
			    			<td>Метод на обучение</td>
			    			<td>Присъствен, Онлайн</td>
			    		</tr> -->
			    		<tr>
			    			<td>Продължителност</td>
			    			<td>{{ $event->theme->duration }} учебни часа</td>
			    		</tr>
			    		<!-- <tr>
			    			<td>Сертификат</td>
			    			<td>Издава се</td>
			    		</tr> -->
			    	</tbody>
			    </table>

			    <h3 class="ui dividing header">
			    	Лектори
			    </h3>
			    @foreach($event->teachers as $teacher)
				    <h3 class="ui header">
				    	<img src="/photos/{{ $teacher->image }}" class="ui circular image">
				    	{{ $teacher->name }}
				    </h3>
				    <p>{{ $teacher->details }}</p>
			    @endforeach
			    <!-- <google-map></google-map> -->
			    <div id="comments">
			    	<comments
			    		auth="{{ Auth::check() }}"
			    		type="theme"
				    	id="{{ $event->theme->id }}"
				    	user_id="{{ auth()->id() }}">
				    </comments>	
			    </div>
			</div>
			<div class="six wide column">
				<h3 class="ui dividing header">Популярни обучения</h3>
				<related-feed
					auth="{{ auth()->check() }}"
					company_id="{{ $event->theme->company->id }}">
				</related-feed>
			</div>
		</div>

	</div>
</div>
@endsection