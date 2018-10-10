@extends('master')

@section('jumbotron')

@include('partials.jumbotron')

@endsection

@section('content')

<a href="{{route('createBadge')}}">Create Badge</a>

<h1>HOME PAGE</h1>

@endsection

      