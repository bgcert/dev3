@extends('layouts.app')

@push('header-scripts')
	<style>
		.flex { display: flex; }
		.logo { flex: 1; }
		.company-details { flex: 3; text-align: center; }
	</style>
@endpush

@section('content')
<div class="sub-nav" style="background-color: #fff; padding: 10px; border-bottom: 1px solid #DDDDDD;">
	<div class="ui container">
		<div class="ui breadcrumb">
			<a href="/" class="section">Начало</a>
			<i class="right angle icon divider"></i>
			<a href="/v" class="section">Зали</a>
			<i class="right angle icon divider"></i>
			<div class="active section">{{ $venue->name }}</div>
		</div>
	</div>
</div>

<div class="ui container">
	<div class="ui grid">
		<div class="column">
			<venue-slider
				id="{{ $venue->id }}"
				cover="{{ $venue->cover }}">
			</venue-slider>
		</div>
	</div>
	<div class="ui segment padded grid">
		<div class="row">
			<div class="ten wide column">
				<div class="row">
					<h2>{{ $venue->name }}</h2>
				    <p>
				    	{{ $venue->description }}
				    </p>
				    <p>
				    	<table class="ui celled padded table">
					    	<tbody>
					    		<tr>
					    			<td>Капацитет</td>
					    			<td>{{ $venue->capacity }} места</td>
					    		</tr>
					    		<tr>
					    			<td>Адрес</td>
					    			<td>{{ $venue->city->name }}, {{ $venue->address }}</td>
					    		</tr>
					    	</tbody>
					    </table>
				    </p>
				</div>
				
				<div class="row">
					<!-- <google-map></google-map> -->
					<div class="ui divider"></div>
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
			<div class="six wide column">
				<div class="ui segment">
					<div class="flex">
						<div class="logo">
							<a href="/c/{{ $venue->company->slug }}"><img class="ui tiny rounded image" src="{{ $venue->company->logo }}"></a>
						</div>
						<div class="company-details">
							<h3>{{ $venue->company->name }}</h3>
							<a href="/c/{{ $venue->company->slug }}" class="ui basic button">Фирмен профил</a>
						</div>
					</div>
					<div class="ui divider"></div>
					<div class="ui horizontal statistics">
						<div style="width: 100%;">
							<p>
								<button class="ui fluid labeled icon big orange button">
									<i class="envelope outline icon"></i>
									Изпратете запитване
								</button>	
							</p>
							<p>
								<button class="ui fluid labeled icon big primary button">
									<i class="mobile alternate icon"></i>
									{{ $venue->company->phone }}
								</button>
							</p>
						</div>
					</div>
				</div>
				<!-- <div>
					<a href="#"><i class="flag icon"></i> Докладвай</a>
				</div> -->
				<h3 class="ui dividing header">Популярни обучения</h3>
				<related-feed
					auth="{{ auth()->check() }}"
					company_id="{{ $venue->company->id }}"
					>
				</related-feed>
			</div>
		</div>
	</div>
    
    
</div>
@endsection