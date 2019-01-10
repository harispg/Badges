@extends('master')
@section('content')
	<form method="POST" action="/tags/{{$badge->id}}">
		@csrf
		<label for="inputic">Tagovi</label>
			<input name='tags' type="text" data-role="tagsinput" 
			value="@foreach($badge->tags as $tag){{$tag->name}},@endforeach">

		<button type="submit">Posalji</button>
	</form>
@endsection