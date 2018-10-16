@extends('master')

@section('jumbotron')

@include('partials.jumbotron')

@endsection

@section('content')

<div class="container">

	<h1>HOME PAGE</h1>

	@can('create-badges')
	<a href="{{route('createBadge')}}"><h3>Create Badge</h3></a>
	@endcan

</div>
@endsection

@section('script')

@include('flash')

@endsection
      