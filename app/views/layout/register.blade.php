@extends('layout.master')
@section('content')

<div class="registration">

{{ Form::open(array('url'=>'registration')) }}
{{ Form::text('email','email@foundationu.com') }} 
{{ Form::submit('Register!')}}
{{ Form::close() }}
</div>

@stop