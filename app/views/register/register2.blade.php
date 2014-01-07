@extends('layout.master')
@section('content')
<div class="row-fluid">
	<div id="main" class="span7">
		{{ Form::open(array('url'=>'register')) }}
		{{ Form::text('email') }}
		{{ Form::submit('register') }}
		{{ Form::close() }}
	</div>
</div>
@stop