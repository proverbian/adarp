@extends('user.master')
@section('title')
	 Dashboard
@stop
@section('header')
	 Adarp - Dashboard
@stop
@section('content')

<div class="wrapper">

@if (Auth::check()) 
	Welcome {{ Auth::user()->username }} !

	<a href="{{ URL::to('registered')}}">Registered Users</a> 

	  @if (Session::has('already_registered'))
	  	<br />
        <span class="error">You are already Registered.</span>
    @endif
@else
	{{  Redirect::to('login'); }}
@endif

</div>

@stop