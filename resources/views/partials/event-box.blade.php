<div class="col-3 py-2">
	<div class="card h-100">
		<div class="cover" style="background: url(https://d3cwccg7mi8onu.cloudfront.net/360x132/{{ $event->cover }})">
			
		</div>

		<div class="logo">
			<a href="/c/{{ $event->theme->company->slug }}">
				<img src="https://d3cwccg7mi8onu.cloudfront.net/56x56/{{ $event->theme->company->logo }}">
			</a>
		</div>
		<div class="card-body mt-3">
			<a href="/event/{{ $event->id }}" class="card-title">{{ $event->theme->title }}</a>
			<p class="card-text mt-2">{{ $event->city->name }}, {{ $event->start_date_carbon }}</p>
		</div>

		<div class="card-footer">
			<div class="d-flex align-items-center justify-content-sm-between">
				<div>
					{{ $event->price }} лв.
				</div>
				<div>
					<i class="fas fa-eye"></i>
					{{ $event->visits }}
				</div>
			</div>
		</div>

		<div class="item box">
			<!-- <div class="cover" style="background: url(https://d3cwccg7mi8onu.cloudfront.net/266x132/{{ $event->cover }})">
				<a href="/c/{{ $event->theme->company->slug }}" class="c-logo">
					<div style="background: url(https://d3cwccg7mi8onu.cloudfront.net/56x56/{{ $event->theme->company->logo }})"></div>
				</a>
			</div>
			<div class="content">
				<a href="/event/{{ $event->id }}" class="title">
					{{ $event->theme->title }}
				</a>
				<div class="date">
					{{ $event->city->name }}, {{ $event->start_date_carbon }}
				</div>
			</div> -->
		</div>

	</div>
</div>