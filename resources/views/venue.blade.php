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
			$('.slide-container .item').css('background-image', 'url("https://d3cwccg7mi8onu.cloudfront.net/1000x400/' + images[current-1] + '")');
		}

		$('#number').click(function() {
		    $(this).find('span').text( $(this).data('number') );
		});
	</script>
@endpush

@section('content')

<div class="container">
	<div class="venue">
		<div class="slide-container">
			<div class="item"></div>
			<a class="prev" onclick="prevSlide()">&#10094;</a>
	  		<a class="next" onclick="nextSlide()">&#10095;</a>
		</div>
		<div class="aligned sub-header indented">
			<div class="aligned">
				<i class="fas fa-map-marker-alt"></i>
				{{ $venue->city->name }}, {{ $venue->address }}
			</div>
			<div>
				<contact-publisher
					button-text="Изпрати запитване"
					:company-id="{{ $venue->company->id }}"
					about="{{ $venue->name }}"
					btn-class="inverted btn">
				</contact-publisher>
			</div>
		</div>
		<div class="grid grid-5-2 mtop indented">
			<div>
				<h2>{{ $venue->name }}</h2>
				<div>
					<div class="description">
				    	{{ $venue->description }}
				    </div>	
				</div>
				<div>
					<table>
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
				</div>
			</div>
			<div>
				<div>
					<img src="https://d3cwccg7mi8onu.cloudfront.net/fit-in/250x250/{{ $venue->company->logo }}">
				</div>
				<div>
					<h3>{{ $venue->company->name }}</h3>
					<a href="/c/{{ $venue->company->slug }}" class="btn blue fluid">Фирмен профил</a>
				</div>
				<div>
					@if($venue->company->phone != '')
					<p>
						<a
							id="number"
							class="btn blue fluid"
							data-number="{{$venue->company->phone}}">
							<i class="mobile alternate icon"></i>
							<span>
								{{ str_limit($venue->company->phone, 2, str_repeat("X", strlen($venue->company->phone) - 2)) }}
							</span>
						</a>
					</p>
					@endif
				</div>
			</div>
		</div>
	</div>
	<div>
		<h3 class="ui dividing header">Популярни обучения</h3>
		<related-feed
			auth="{{ auth()->check() }}"
			company_id="{{ $venue->company->id }}">
		</related-feed>
	</div>
	<div>
		<comments
    		auth="{{ Auth::check() }}"
    		type="venue"
	    	id="{{ $venue->id }}"
	    	user_id="{{ auth()->id() }}">
	    </comments>
	</div>
</div>
@endsection