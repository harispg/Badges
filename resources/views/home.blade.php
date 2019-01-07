@extends('master')

@section('jumbotron')

@include('partials.jumbotron')

@endsection

@section('content')

<div class="container">
  <div class="row">
<div class="col col-md-10">
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
                  <p class="card-text">{{$badge->name}}</p>
                  <div class="article d-flex justify-content-between align-items-center">
                    @if(auth()->check())
                    <i id="like{{$badge->id}}" data-model="badge{{$badge->id}}" class="{{$badge->isLiked(auth()->id())?'fa fa-heart':'far fa-heart'}}"
                       style="font-size:2em;color:red">
                    </i>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input form="sideBarForm" name="name{{$badge->id}}" type="checkbox" data-badge="{{$badge->id}}" class="form-check-input checkbox" value="">
                      </label>
                    </div>
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

<div class="col col-md-2">
  <div class="sidepanel" style="padding-top: 6em;">
    <h3>Selected badges</h3>
    <ul id="sidebar">
    </ul>
    <form id="sideBarForm" action="/selectedBadges" method="POST">
      @csrf
      <div class="formgroup">
        <button type="submit">Delete selected</button>
      </div>
    </form>
  </div>
</div>

</div>

</div>





@endsection

@section('script')

<script type="text/javascript">
  $(document).ready(function(){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(".checkbox").change(function(){
      $.ajax({
        url: '/ajaxSelected',
        method: 'POST',
        data: {_token: CSRF_TOKEN, badge: $(this).data('badge')},
        success: function(selectedBadge){
          $("#sidebar").append("<li>"+selectedBadge+"</li>")
        }
      });
    });
  });

</script>
	@include('scripts')
@endsection

