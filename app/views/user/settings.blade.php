@extends('user.master')

@foreach ($data as $key => $val)
	@section($key)
		{{ $val }}
	@stop
@endforeach

@section('content')

@if (Session::has('success_changepass'))
        <span class="error"> {{ @$msg }} </span>
        <br />
 @endif


@if (Session::has('failed_changepass'))
	
        <span class="error"> {{ Session::get('errors') }} </span>
 @endif

{{ Form::open(array('url'=>'profile/updatepass','method'=>'post'))}}
{{ Form::hidden('user_id',Auth::user()->id) }}
{{ Form::hidden('chpass_type','update') }}



<div>

<table class="row">
<th colspan="2">Change password</th>
<tr> 
	 <th>Old Password</th>
	 <td>{{ Form::password('old_password') }} </td>
</tr>
<tr>
	<th>New Password</th>
	<td> {{ Form::password('password') }} </td>
</tr>

<tr>
	<th>Confirm New Password</th>
	<td> {{ Form::password('password_confirmation') }} </td>
</tr>
<tr> 
	<th></th>
	<td> {{ Form::submit('submit') }} </tr>
</tr>

</div>

{{ Form::close() }}

@stop

@stop