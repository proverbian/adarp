@extends('layout.master')
@section('content')

    <!-- check for login errors flash var -->
    @if (Session::has('register_errors'))
        <span class="error">Please Fill up Required Fields</span>
    @endif
<div class="register_form">


{{ Form::open(array('url'=>'register','method'=>'post')) }}

@foreach ($array as $arr)
	<h3> {{ $arr->name }} </h3> 
	@foreach ($arr->value as $val)
		{{ Form::label($val->name) }}
		@if ($val->type=='select') <!-- <select> -->
			{{ Form::select($val->key_id,$val->arr_val,Session::get($val->key_id)) }} 
		@else   <!-- <input> -->
			{{ Form::input($val->type,$val->key_id,Session::get($val->key_id)) }}
		@endif
		@if ($val->required == 1)
			<span class="req_field">*</span> 
		@endif
	@endforeach
@endforeach

<br />
{{  Form::submit('Register') }}
{{  Form::close() }} 

</div>

@stop