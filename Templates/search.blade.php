<h1>Template</h1>

@foreach($bands as $band)
	<p>{{$band->get("name")}}</p>
@endforeach
<p><a href="/">Root</a></p>
<p><a href="/session">Session</a></p>
<p><a href="/get/10">Get 10</a></p>