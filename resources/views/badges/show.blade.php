@extends('master')

@section('content')

<div class="row">
	<div class="col-md-4">

		    <div class="thumbnail">

		        <img src="/{{$badge->photo_path}}" alt="Nature" style="width:100%">
		        <div class="caption">
		          <p>{{$badge->name}}</p>
		        </div>

    		</div>

	</div>
</div>
@endsection