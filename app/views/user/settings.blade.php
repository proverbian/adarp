@extends('user.master')

@foreach ($data as $key => $val)
	@section($key)
		{{ $val }}
	@stop
@endforeach

@section('content')



{{ Form::open(array('url'=>'profile/updatepass','method'=>'post'))}}
{{ Form::hidden('user_id',Auth::user()->id) }}
{{ Form::hidden('chpass_type','update') }}



<div class="container">
	<div class="row">
		
			@if (Session::has('success_changepass'))
 		      <div class="col-md-12 alert alert-warning"> {{ @$msg }} </div>
   			@endif
   		</div>

   		<div class="row">
			@if (Session::has('failed_changepass'))
			      <div class="col-md-12 alert alert-warning">
			       	{{ Session::get('errors') }} 
			      </div>
			 @endif
		</div>

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
						<label class="control-label col-md-4">Old Password</label>
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

@stop

@stop