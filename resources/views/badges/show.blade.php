@extends('master')

@section('content')

<div class="row">
	<div class="col-md-4 alert alert-success">
		    <div class="thumbnail">
		    	<div class="display-3">
		    		{{$badge->name}}
		    	</div>

		        <img src="/{{$badge->photo_path}}" alt="Nature" style="width:50%">
		        <div class="caption">
		          <p>{{$badge->description}}</p>
		        </div>

    		</div>

	</div>
	<div class="col-md-8">

			<form action="{{route('storePhoto', ['badge' => $badge])}}" class="dropzone" id="addPhotosToBadge">

			@csrf

		</form>


	</div>
</div>
@endsection

@section('script')
	<script src="/js/dropzone.js"></script>
	<script type="text/javascript">
		Dropzone.options.addPhotosToBadge = {
		  paramName: "photo", // The name that will be used to transfer the file
		  maxFilesize: 2, // MB
		  acceptedFiles: '.jpg,.jpeg,.bmp,npg',
		};
	</script>
@endsection