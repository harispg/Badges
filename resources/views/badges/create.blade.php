@extends('master')

@section('content')


<div class="col-md-4 offset-4">

<h1>Create a badge</h1>

<hr>

<form enctype="multipart/form-data" method="POST" action="{{route('storeBadge')}}">
	@csrf

	<div class"form-group">
		<label for="name">Name</label>
		<input type="text" name="name" class="form-control" id="name" value="{{old('name')}}" required></input>
		@if ($errors->has('name'))
            <span class="text-danger" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
	</div>

	<div class"form-group">
		<label for="description">Description</label>
		<textarea class="form-control" rows="8" name="description" required></textarea>
	</div>
		@if($errors->has('description'))
            <span class="text-danger" role="alert">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif

	<div class="form-group">
		<label for="photo">Upload photo</label>
		<input name="photo" class="form-control" type="file" required></input>
	</div>
		@if($errors->has('photo'))
            <span class="text-danger" role="alert">
                <strong>{{ $errors->first('photo') }}</strong>
            </span>
        @endif

	<div class"form-group">
		<button type="submit" class="form-control btn btn-primary">Create badge</button>
	</div>
		
	
</form>

</div>

@endsection