@if(auth()->check())
    <h4 class="mt-5">Comments:</h4>
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
	           <button  class="btn btn-primary btn-outline-primary"type="submit" name="button">Add Comment</button>
	         </div>
        </form>
@endif