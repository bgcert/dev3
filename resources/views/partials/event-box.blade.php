<div class="col-lg-3 col-md-6 col-sm-12 py-2">
	<div class="card event-card h-100">
		<div class="cover" style="background: url(https://d3cwccg7mi8onu.cloudfront.net/360x132/{{ $event->cover }})">
			
		</div>

		<div class="d-flex align-items-center logo" data-toggle="tooltip" data-placement="right" title="{{ $event->theme->company->name }}">
			<a href="/c/{{ $event->theme->company->slug }}" title="{{ $event->theme->company->name }}">
				<img src="https://d3cwccg7mi8onu.cloudfront.net/fit-in/56x56/{{ $event->theme->company->logo }}" alt="{{ $event->theme->company->name }}">
			</a>
		</div>
		<div class="card-body mt-3">
			<a href="/{{ $event->theme->slug }}/{{ $event->month_slug }}/{{ $event->id }}" class="card-title" title="{{ $event->theme->title }}">{{ $event->theme->title }}</a>
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
	</div>
</div>