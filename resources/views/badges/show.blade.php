@extends('master')

@section('content')
<div class="row">
	<div class="col-md-4">

	    <div class="thumbnail">
	    	<div class="display-3">
	    		{{$badge->name}}
	    	</div>

	        <img id="avatar" src="/@if(null !== $badge->mainPhoto()){{$badge->mainPhoto()->thumbnail_path}} @endif" alt="Nature" style="width:50%">
	        <div class="caption">
	          <p id="haris">{{$badge->description}}</p>
	        </div>
          @if(auth()->check())
            <form method="POST" action="/items">
              @csrf
              <div class="form-group">
                <label for="qty">Quantity</label>
                <input class="form-control" type="number" name="qty" value="1">
                <input type="number" name="badge_id" value="{{$badge->id}}" hidden>
                <input type="number" name="user_id" value="{{auth()->id()}}" hidden>
                <button class="btn btn-primary form-control" type="submit">Add to Cart</button>
              </div>
            </form>
          @endif

	        @can('create-badges')
	        	<a class="btn btn-primary" href="{{route('editBadge', ['id' => $badge->id])}}">Edit this badge</a>
	        	<a class="btn btn-primary" href="" onclick="event.preventDefault(); document.getElementById('deleteBadgeForm').submit();">Delete this badge</a>
	        	<form method="POST" action="{{route('deleteBadge', ['id'=>$badge->id])}}" id="deleteBadgeForm" style="display:none">
	        		@csrf
	        		<input type="hidden" name="_method" value="DELETE">
	        	</form>

            <form method="POST" action="/tags/{{$badge->id}}" class="mt-4">
              @csrf
              <div class="form-group">
              <label for="inputic">Type in any tags you wish:</label>
                <input name='tags' class="form-control" type="text" data-role="tagsinput" 
                value="@foreach($badge->tags as $tag){{$tag->name}},@endforeach">
              </div>
              <div class="form-group">
                <button class="btn btn-primary btn-outline-primary mb-5" type="submit">Apply tags</button>
              </div>
            </form>
	        @endcan

          <div>
            <h4>Tags:</h4>
                @foreach($badge->tags as $tag)
                  <a href="/badges/tags/{{$tag->name}}" class="btn btn-primary outline-primary"style="padding-right: 1em">#{{$tag->name}}</a>
                @endforeach
          </div>
	        {{-- Here is encapsulated blade for showing and creating comments --}}
	        @include('comments')


		</div>
    {{-- <div class="row basket">
      <form method="post" action="/itmes">
        <div class="form-group">
          <label for="qty">Quantity</label>
          <input class="form-controll" type="text" name="qty">
          <button class="btn btn-primary" type="submit">Add to Cart</button>
        </div>
      </form>
    </div> --}}
	</div>
	<div class="col-md-8" id="photoGrid">
      @foreach($badge->photos->chunk(4) as $set)
        <div class="row" id="photoRow">
          @foreach ($set as $photo)
            <div class="col-md-3">
              <div class="card mb-4 shadow-sm">
                {{-- <a href="/{{$photo->path}}"> --}}<img class="card-img-top" src="/{{ $photo->thumbnail_path}}" id="photo{{$photo->id}}">{{-- </a> --}}
                <div class="card-body">
                  <div class="article d-flex justify-content-between align-items-center">
                    <div class="btn-group col-sm-6 justify-content-between">
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
    </div>
    <div class="row">
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