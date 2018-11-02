@extends('master')
@section('content')

<div class="album py-5 bg-light">
  <div class="container">

    <div class="row">
      <div class="col-md-4">
        @foreach($badges as $badge)
            <div class="thumbnail">
              <a href="{{route('showBadge', [$badge->id])}}">
                <img src="{{$badge->mainPhoto()->thumbnail_path}}" alt="Nature" style="width:100%">
                <div class="caption">
                  <p>{{$badge->name}}</p>
                </div>
              </a>
            </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

@endsection