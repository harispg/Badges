@extends('master')

@section('jumbotron')

@include('partials.jumbotron')

@endsection

@section('content')

<div class="container">


		@foreach($badges->chunk(4) as $set)
			<div class="row">
			@foreach($set as $badge)
				<div class="col-md-3">

						<a href="/badges/{{$badge->id}}">
							<div class="thumbnail">
								<img src="/{{$badge->mainPhoto()->thumbnail_path}}">
							</div>
						</a>
					
				</div>
			@endforeach
			</div>
		@endforeach


	@can('create-badges')
	<a href="{{route('createBadge')}}"><h3>Create Badge</h3></a>
	@endcan

</div>
@endsection

      