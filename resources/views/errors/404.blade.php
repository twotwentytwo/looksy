@extends('templates.default')  

@section('title')
  Oh dear
@stop

@section('body-class')
  error-404
@stop

@section('navigation')
    @include('templates.partials.navigation')
@stop

@section('content')
  <p>There seems to have been an error.</p>
  <p>Please try <a href="{{ route('home') }}">logging in again</a></p>
@stop            
       