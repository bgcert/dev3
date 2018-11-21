<div class="col-lg-12 col-md-6 col-sm-6 py-2">
	<div class="card event-card h-100">
		<div class="cover" style="background: url('https://d3cwccg7mi8onu.cloudfront.net/266x132/{{ $theme->cover }}')">
			
		</div>

		<div class="logo">
			<a href="/c/{{ $theme->company->slug }}">
				<img src="https://d3cwccg7mi8onu.cloudfront.net/56x56/{{ $theme->company->logo }}">
			</a>
		</div>

		<div class="card-body mt-3">
			<a href="/theme/{{ $theme->id }}" class="card-title">{{ $theme->title }}</a>
		</div>
	</div>
</div>