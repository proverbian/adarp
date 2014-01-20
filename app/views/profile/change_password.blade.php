@extends('layout.master')
@section('content')

<style>


</style>



<div class="row">

	<div class="col-xs-1  col-sm-4 col-md-4 col-lg-4">
	@if ($errors)

		 @foreach( $errors->all() as $message )
        		  <li class="well well-sm">{{ $message }}</li>
 		 @endforeach

	@endif
	</div>
	<div class="col-xs-10 col-sm-6 col-md-5  col-lg-4 pass_frame">
			{{ Form::open(array('url'=>'register/setpass','method'=>'post'))}}
			{{ Form::hidden('user_id',Auth::user()->id) }}
			<div class="frmlabel">
				<span class="lbl"><p class="pass_icon"></p>SET NEW PASSWORD </span> <br/>
				<span class="notice">You password should be atleast 8 characters long</span></div>
			<div class="form-group">
			{{ Form::password('password',array('class'=>'form-control','placeholder'=>'New Password')) }} <br />	
			{{ Form::password('password_confirmation',array('class'=>'form-control','placeholder'=>'Repeat Password')) }} <br />	
			{{ Form::submit('submit',array('class'=>'btn btn-primary','Value'=>'Set Password')) }}
			</div>

			{{ Form::close() }}
		
	</div>
	<div class="col-xs-1 col-sm-3 col-md-3 col-lg-4"></div>
</div>
@stop