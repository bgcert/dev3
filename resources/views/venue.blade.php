@extends('layouts.app')

@push('footer-scripts')
	<script>
		let images = {!! json_encode($images) !!};
		let count = images.length;
		let current = 1;
		if (count > 0) {
			showSlide(current);
		}

		function nextSlide() {
			if (count > 0 && current < count) {
				current++;
				showSlide();
			}
		}

		function prevSlide() {
			if (count > 1 && current > 1) {
				current--;
				showSlide();
			}
		}

		function showSlide() {
			if (current == count) {
				$('.slide-container .next').hide();
			} else if(current == 1) {
				$('.slide-container .prev').hide();
			} else {
				$('.slide-container .next').show();
				$('.slide-container .prev').show();
			}
			$('.slide-container .item').css('background-image', 'url("https://d3cwccg7mi8onu.cloudfront.net/1000x400/' + images[current-1] + '")');
		}
	</script>
@endpush

@section('content')

<div class="container">
	<div class="grid grid-5-2">
		<div class="slide-container">
			<div class="item"></div>
			<a class="prev" onclick="prevSlide()">&#10094;</a>
	  		<a class="next" onclick="nextSlide()">&#10095;</a>
		</div>
		<div>
			test
		</div>
	</div>
</div>

<div class="ui container">
	<div class="ui grid">
		<div class="column">
			<!-- <venue-slider
				id="{{ $venue->id }}"
				cover="{{ $venue->cover }}">
			</venue-slider> -->
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
					    	user_id="{{ auth()->id() }}">
					    </comments>
				    </div>
				</div>
			</div>
			<div class="six wide column">
				<div class="ui segment">
					<div class="flex">
						<div class="logo">
							<img class="ui image" src="https://d3cwccg7mi8onu.cloudfront.net/fit-in/250x250/{{ $venue->company->logo }}">
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
							@if($venue->company->phone != '')
							<p>
								<button
									id="number"
									class="ui fluid labeled icon big primary button"
									data-number="{{$venue->company->phone}}">
									<i class="mobile alternate icon"></i>
									<span>
										{{ str_limit($venue->company->phone, 2, str_repeat("X", strlen($venue->company->phone) - 2)) }}
									</span>
								</button>
							</p>
							@endif
						</div>
					</div>
				</div>
				<!-- <div>
					<a href="#"><i class="flag icon"></i> Докладвай</a>
				</div> -->
				<h3 class="ui dividing header">Популярни обучения</h3>
				<related-feed
					auth="{{ auth()->check() }}"
					company_id="{{ $venue->company->id }}">
				</related-feed>
			</div>
		</div>
	</div>
    
    
</div>
@endsection