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
				           <textarea type="text" class="form-control" name="body" rows="8" placeholder="Your comment" required></textarea>
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
	<div class="col-md-8" id="photoGrid">
      @foreach($badge->photos->chunk(4) as $set)
        <div class="row" id="photoRow">
          @foreach ($set as $photo)
            <div class="col-md-3">
              <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="/{{ $photo->thumbnail_path}}" id="photo{{$photo->id}}">
                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                    	@can('create-badges')
			              <form method="POST" action="{{route('deletePhoto', ['photo' => $photo->id])}}">
			              	@csrf
			              	@method('DELETE')
			              	<button type="button" class="delete btn btn-sm btn-outline-secondary" data-photo="{{$photo->id}}">Delete photo</button>
			              </form>
			              	<button type="submit" class="check btn btn-sm btn-outline-primary {{$photo->main_picture?"active" : ""}}" data-photo="{{$photo->id}}">Set Avatar</button>
              			@endcan
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
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
			$(".check").on('click',function(){
				var photoId = "#photo" + $(this).data("photo");
				var realPhotoId = $(this).data("photo");
				$(".active").removeClass('btn btn-sm btn-outline-primary active').addClass('btn btn-sm btn-outline-primary');
				$(this).removeClass('btn btn-sm btn-outline-primary').addClass('btn btn-sm btn-outline-primary active');	
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
	<script type="text/javascript">
		$(document).ready(function(){
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			$(".delete").on("click",".delete",function(){
				console.log('clicked');
				var realPhotoId = $(this).data("photo");
				$.ajax({
					url: '/ajaxDeletePhoto',
					method: 'POST',
					data: {_token: CSRF_TOKEN, photo: realPhotoId},
					success: function(photos){
						renderPictures(photos);
					}
				});
			});

			function renderPictures(photos){
				$("#photoGrid").html("");
						var fullRows = Math.floor(photos.length / 4);
						var leftOver = photos.length - fullRows*4;
						var photoNumber = 0;
						if(leftOver>0){
							var lastRow=1;
						}else{
							var lastRow=0;
						}
						for (var rows = 0; rows < fullRows+lastRow; rows++) {
							$("#photoGrid").append("<div class='row' id='photoRow'>");
								console.log("red: "+rows);
							if(rows == fullRows){
								for (j = 0; j<leftOver; j++) {
									console.log("slika: "+ j);
									$("#photoRow").append("<div class='col-md-3'><div class='card mb-4 shadow-sm'><img class='card-img-top' src='/"+photos[photoNumber].thumbnail_path+"'id='"+photos[photoNumber].id+"'><div class='card-body'><p class='card-text'>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p><div class='d-flex justify-content-between align-items-center'><div class='btn-group'><button type='button' class='delete btn btn-sm btn-outline-secondary' data-photo='"+photos[photoNumber].id+"'>Delete photo</button><button type='submit' class='check btn btn-sm btn-outline-primary' data-photo='"+photos[photoNumber].id+"'>Set Avatar</button></div><small class='text-muted'>9 mins</small> </div></div></div></div>");
									if(j=leftOver-1){
										$("#photoGrid").append("</div></div>");
									}
									photoNumber++;
								}
							}else{
								for (j = 0; j<4; j++) {
									console.log("slika: "+ j);
									$("#photoRow").append("<div class='col-md-3'><div class='card mb-4 shadow-sm'><img class='card-img-top' src='/"+photos[photoNumber].thumbnail_path+"'id='"+photos[photoNumber].id+"'><div class='card-body'><p class='card-text'>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p><div class='d-flex justify-content-between align-items-center'><div class='btn-group'><button type='button' class='delete btn btn-sm btn-outline-secondary' data-photo='"+photos[photoNumber].id+"'>Delete photo</button><button type='submit' class='check btn btn-sm btn-outline-primary' data-photo='"+photos[photoNumber].id+"'>Set Avatar</button></div><small class='text-muted'>9 mins</small> </div></div></div></div>");
									photoNumber++;
								}
							}
						    
						}
			}
		});
	</script>
@endsection