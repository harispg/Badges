@extends('master')

@section('content')

<div class="row">
	<div class="col-md-4 alert alert-success">
	    <div class="thumbnail">
	    	<div class="display-3">
	    		{{$badge->name}}
	    	</div>

	        <img id="avatar" src="/@if(null !== $badge->mainPhoto()){{$badge->mainPhoto()->thumbnail_path}} @endif" alt="Nature" style="width:50%">
	        <div class="caption">
	          <p id="haris">{{$badge->description}}</p>
	        </div>

	        @can('create-badges')
	        	<a class="btn btn-primary" href="{{route('editBadge', ['id' => $badge->id])}}">Edit this badge</a>
	        	<a class="btn btn-primary" href="" onclick="event.preventDefault(); document.getElementById('deleteBadgeForm').submit();">Delete this badge</a>
	        	<form method="POST" action="{{route('deleteBadge', ['id'=>$badge->id])}}" id="deleteBadgeForm" style="display:none">
	        		@csrf
	        		<input type="hidden" name="_method" value="DELETE">
	        	</form>
	        @endcan
	        @if(auth()->check())
	        	  <h4>Comments:</h4>
				    <ul class="list-group">
				      @foreach($badge->comments as $comment)

				          <li class="list-group-item">
				            <strong>
				              {{$comment->created_at->diffForHumans()}}:
				            </strong>
				            {{$comment->body}}
				          </li>

				      @endforeach
				      </ul>


					<h2>Create your comment</h2>
					  <form action="{{route('addComment', ['badge'=>$badge->id])}}" method=POST>
					        {{ csrf_field() }}
					         <div class="form-group">

					           <textarea type="text" class="form-control" name="body" rows="8" placeholder="gvgh" required></textarea>

					           @if($errors->has('body'))
					           	<div class="alert alert-danger">{{$errors->first('body')}}</div>
					           @endif

					         </div>
					         
					         <div class="form-group">
					           <button type="submit" name="button">Add Comment</button>
					         </div>

					      </form>
	        @endif
		</div>

	</div>
	<div class="col-md-8">
      @foreach($badge->photos->chunk(4) as $set)
        <div class="row">
          @foreach ($set as $photo)
            <div class="col-md-3 gallery__image">
              <a href="/{{$photo->path}}"  data-lity>
                <img src="/{{ $photo->thumbnail_path}}" id="photo{{$photo->id}}">
              </a><br>
              <form method="POST" action="{{route('deletePhoto', ['photo' => $photo->id])}}">
              	@csrf
              	@method('DELETE')
              	<button type="submit">Delete this photo</button>
              </form>
              <input type="radio" class="radio-button" name="mainPhoto" data-photo="{{$photo->id}}"{{$photo->main_picture?'checked' : ''}}>Set as main picture<br>
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
	<script type="text/javascript">
		$(document).ready(function(){
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			$(".radio-button").click(function(){
				var photoId = "#photo" + $(this).data("photo");
				var realPhotoId = $(this).data("photo");
				$.ajax({
					url: '/ajaxPhoto',
					method: 'POST',
					data: {_token: CSRF_TOKEN, photo: realPhotoId},
					success: function(photo){
						$("#avatar").attr("src", "/"+photo.thumbnail_path);
					} 
				});
			});
		});
	</script>
@endsection