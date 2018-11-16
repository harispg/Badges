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
                  <div class="article d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                    	@can('create-badges')
			              <form method="POST" action="{{route('deletePhoto', ['photo' => $photo->id])}}">
			              	@csrf
			              	@method('DELETE')
			              	<button type="button" class="delete btn btn-sm btn-outline-secondary" data-photo="{{$photo->id}}">Delete photo</button>
			              </form>
			              	<button type="button" class="check btn btn-sm btn-outline-primary {{$photo->main_picture?"active" : ""}}" data-photo="{{$photo->id}}">Set Avatar</button>
              			@endcan
                    </div>
                    @if(auth()->check())
                    <i id="like{{$photo->id}}" data-model="photo{{$photo->id}}" class="{{$photo->isLiked(auth()->id())?'fa fa-heart':'far fa-heart'}}"
                       style="font-size:2em;color:red">
                    </i>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endforeach
    </div>
    <div class="col-md-8 offset-4">
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
	@include('scripts')
@endsection