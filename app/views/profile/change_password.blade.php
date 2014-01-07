@extends('layout.master')
@section('content')


@if (Session::has('success_changepass'))
        <span class="error"> {{ @$msg }} </span>
        <br />
 @endif


{{ Form::open(array('url'=>'profile/changepass','method'=>'post'))}}
{{ Form::hidden('user_id',Auth::user()->id) }}

<span> You must set your Password first before proceeding .. </span> 
<br />
<br />

<div>
{{ Form::password('password') }} <br />	
{{ Form::password('password_confirmation') }} <br />	
{{ Form::submit('submit') }}
</div>

{{ Form::close() }}
@stop