@extends('master')

@section('content')
<div class="row">
	<div class="display-3 col-md-6 offset-3" style="text-align:center; padding-top: 0.5em;">User Actions</div>
</div>

<div class="row" id="usersTable">
	<div class="col-md-8 offset-2">
		<table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Registered</th>
        <th>Last login</th>
        <th>Login Count</th>
        <th>Liked Badges</th>

      </tr>
    </thead>
    <tbody>
    	@foreach($users as $user)
	      <tr>
	        <td>{{$user->name}}</td>
	        <td>{{$user->email}}</td>
	        <td>{{$user->created_at->toFormattedDateString()}}</td>
	        <td>{{$user->updated_at->toFormattedDateString()}}</td>
	        <td>{{$user->numberOfLogins}}</td>
	        <td>Ukupno: {{$user->badges()->count()}}
	        	<div class="col">
		        	@foreach($user->badges->chunk(4) as $set)
		        		<div class="row">
		        			@foreach($set as $badge)
		        				<a class="btn btn-link" href="{{route('showBadge',[$badge->id])}}">
		        					{{$badge->name}}
		        				</a>
		        			@endforeach
			    		</div>
			    	@endforeach
	        	</div>
	        </td>
	      </tr>
      	@endforeach
    </tbody>
  </table>
	</div>
</div>
@endsection