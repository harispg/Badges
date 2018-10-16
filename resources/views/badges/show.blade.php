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

	        @can('create-badges')
	        	<a class="btn btn-primary" href="{{route('editBadge', ['id' => $badge->id])}}">Edit this badge</a>
	        	<a class="btn btn-primary" href="podji" onclick="event.preventDefault(); document.getElementById('deleteBadgeForm').submit();">Delete this badge</a>
	        	<form method="POST" action="{{route('deleteBadge', ['id'=>$badge->id])}}" id="deleteBadgeForm" style="display:none">
	        		@csrf
	        		<input type="hidden" name="_method" value="DELETE">
	        	</form>
	        @endcan
		</div>

	</div>
	<div class="col-md-8">
      @foreach($badge->photos->chunk(4) as $set)
        <div class="row">
          @foreach ($set as $photo)
            <div class="col-md-3 gallery__image">
              <a href="/{{$photo->path}}"  data-lity>
                <img src="/{{ $photo->thumbnail_path}}">
              </a>
            </div>
          @endforeach
        </div>
      @endforeach
      @can('create-badges')
         <hr>
         <form id="addPhotosToBadge" class="dropzone" action="{{route('storePhoto', ['badge' => $badge])}}" method="post">
           {{ csrf_field() }}
         </form>
       @endcan
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