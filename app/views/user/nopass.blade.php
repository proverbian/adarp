@extends('user.master')
@section('content')
	You haven't set any password, please set one.
	{{ Form::open(array('url'=>'profile/setpass')) }}
	<table class="table-responsive">
		<tr>
		 	<td>{{ Form::password('password')}}</td>
		 </tr>
		<tr>
		 	<td>{{ Form::password('password_confirmation') }}</td>
		</tr>
		<tr> 
			 <td>{{ Form::submit('Set Password') }}</td>
		</tr>
	</table>
	
	{{ Form::close() }}
@stop