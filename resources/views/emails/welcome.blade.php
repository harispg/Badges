@extends('master')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-6 bg-success">
			<div class="display-1">HELLOOO {{$user}}</div>
		</div>
		<div class="col-md-6 bg-danger text-light">
			<div class="display-1">Welcome to our humble home {{$user}}</div>
		</div>
	</div>
</div>


@endsection