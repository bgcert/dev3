<div class="card card-venue h-100">
	<div class="cover" style="background: url(https://d3cwccg7mi8onu.cloudfront.net/266x132/{{ $venue->cover }})">
		<a href="/c/{{ $venue->company->slug }}" class="c-logo">
			<div style="background: url(https://d3cwccg7mi8onu.cloudfront.net/56x56/{{ $venue->company->logo }})"></div>
		</a>
	</div>
	<div class="card-body">
		<a href="/venue/{{ $venue->id }}" class="card-title">
			{{ $venue->name }}
		</a>
	</div>
</div>