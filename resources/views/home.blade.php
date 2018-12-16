@extends('master')

@section('jumbotron')

@include('partials.jumbotron')

@endsection

@section('content')

<div class="container">

  <div class="row">
    <div class="col">
      {{$badges->links()}}
    </div>
  </div>

<div class="row">
	<div class="col" id="photoGrid">
      @foreach($badges->chunk(4) as $set)
        <div class="row" id="photoRow">
          @foreach ($set as $badge)
            <div class="col-md-3">
              <div class="card mb-4 shadow-sm">
                <a href={{route('showBadge', ['badge' => $badge->id])}}><img class="card-img-top" src="/{{$badge->mainPhoto()->thumbnail_path}}" id="photo{{$badge->id}}"></a>
                <div class="card-body">
                  <p class="card-text">{{$badge->description}}</p>
                  <div class="article d-flex justify-content-between align-items-center">
                    {{-- <div class="btn-group">
                    	@can('create-badges')
			              <form method="POST" action="{{route('deletePhoto', ['photo' => $photo->id])}}">
			              	@csrf
			              	@method('DELETE')
			              	<button type="button" class="delete btn btn-sm btn-outline-secondary" data-photo="{{$photo->id}}">Delete photo</button>
			              </form>
			              	<button type="button" class="check btn btn-sm btn-outline-primary {{$photo->main_picture?"active" : ""}}" data-photo="{{$photo->id}}">Set Avatar</button>
              			@endcan
                    </div> --}}
                    @if(auth()->check())
                    <i id="like{{$badge->id}}" data-model="badge{{$badge->id}}" class="{{$badge->isLiked(auth()->id())?'fa fa-heart':'far fa-heart'}}"
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
    <div class="col">
      {{$badges->links()}}
    </div>
  </div>

</div>


@endsection

@section('script')
	@include('scripts')
@endsection