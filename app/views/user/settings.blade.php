@extends('user.master')

@foreach ($data as $key => $val)
	@section($key)
		{{ $val }}
	@stop
@endforeach

@section('content')

<!-- /*******/  Change Pass  /*******/ -->

{{ Form::open(array('url'=>'profile/updatepass','method'=>'post'))}}
{{ Form::hidden('user_id',Auth::user()->id) }}
{{ Form::hidden('chpass_type','update') }}
<style>
.my_setting li input[type=text] {
	padding-left:50px;
	width:360px;
	background:url('/img/pass.png') no-repeat;
	background-size:20px 20px;
	background-position:10px;
}
</style>
<div class="container">
	<div class="row">
			@if (Session::has('success_changepass'))
 		      <div class="col-md-12 alert alert-warning"> {{ @$msg }} </div>
   			@endif
   		</div>


<!-- 
	<div class="row">
		<div class="col-md-8">
			<ul class="my_setting">
				<li> {{ Form::text('username',$user->username,array('class'=>'form-control','placeholder'=>'username')) }} </li>
				<li> {{ Form::text('fbid',$user->uid,array('class'=>'form-control')) }} </li>
				<li> {{ Form::text('created_at',$user->created_at,array('class'=>'form-control')) }} </li>
			</ul>
		</div>

	</div>
-->


	@if ($errors)
		 @foreach( $errors->all() as $message )
        		  <li class="well well-sm">{{ $message }}</li>
 		 @endforeach
	@endif

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-body text-center"> <h3> Change Password </h3>
				 <div class="row form-group">
						<label class="control-label col-md-4">Old Password</label>
						 <div class="col-md-8">
							{{ Form::password('old_password',array('class'=>'form-control')) }} 
					  	 </div>
					 </div>
					 <div class="row form-group">
						<label class="control-label col-md-4">New Password</label>
						 <div class="col-md-8">
							{{ Form::password('password',array('class'=>'form-control')) }} 
					  	 </div>
					 </div>
					  <div class="row form-group">
						<label class="control-label col-md-4">Repeat New Password</label>
						<div class="col-md-8">
							{{ Form::password('password_confirmation',array('class'=>'form-control')) }}
						</div>
					</div>
					 <div class="row form-group">
						<div class="col-md-4"></div>
						<div class="col-md-8">
							{{ Form::submit('submit',array('class'=>'btn btn-primary')) }}
						</div>
					</div>
				</div>
			<div>
		</div>
	</div>
</div>

{{ Form::close() }}

<!-- /*******/ End Change Pass  /*******/ -->

@stop