@extends('admin.dashboard')
@section('content')

@foreach ($pkeys as $pkey)
	{{ $pkey->name }} <br /> 
@endforeach


@stop