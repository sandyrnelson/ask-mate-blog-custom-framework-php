<h1>Template</h1>

@foreach($bands as $band)
	<p>{{$band->get("name")}}</p>
@endforeach
