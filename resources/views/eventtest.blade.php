<h1>event test</h1>

@foreach($events as $event)
	<li>{{ $event->theme->title }} - {{ $event->cover }}</li>
@endforeach