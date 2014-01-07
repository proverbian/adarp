@extends('admin.dashboard')
@section('content')

Manage Fields!

<br />
<br />


    @if (Session::has('error_dupe'))
        <span class="">Duplicate Entry!</span>
    @endif

    @if (Session::has('success'))
        <span class="">Successfully Added Entry!</span>
        <br />
		<br />
    @endif



{{ Form::open(array('url'=>'admin/manage/fields/add')) }}
{{ Form::label('Name'), Form::text('name') }}
{{ Form::label('Type'), Form::select('type',array('text'=>'Text','select'=>'Select')) }}
{{ Form::label('Parent'), Form::select('parent',$parent) }}
{{ Form::label('Active'), Form::checkbox('active',1) }}

<br />
<br />
{{ Form::submit('Submit') }}
{{ Form::close() }}


@stop