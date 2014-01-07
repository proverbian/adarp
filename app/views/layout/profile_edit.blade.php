@extends('layout.master')
@section('content')

<div class="col-md-3 .col-md-offset-3">
{{ Form::open(array('url'=>'profile/edit')) }}

    <!-- check for login errors flash var -->
    @if (Session::has('login_errors'))
        <span class="error">Username or password incorrect.</span>
    @endif

    @if(Session::has('success'))
    test
@endif

    <!-- username field -->
    <p>{{ Form::label('fname', 'First Name') }}</p>
    <p>{{ Form::text('fname',$user->first) }}</p>

    <!-- username field -->
    <p>{{ Form::label('middle', 'Middle Name') }}</p>
    <p>{{ Form::text('middle',$user->middle) }}</p>
    
        <!-- username field -->
    <p>{{ Form::label('lname', 'Last Name') }}</p>
    <p>{{ Form::text('lname',$user->last) }}</p>
    
        <!-- username field -->
    <p>{{ Form::label('gender', 'Gender') }}</p>
    <p>{{ Form::text('gender',$user->gender) }}</p>
    
    <!-- username field -->
    <p>{{ Form::label('status', 'Status') }}</p>
    <p>{{ Form::text('status',$user->status) }}</p>
    
    <!-- username field -->
    <p>{{ Form::label('dob', 'Date of Birth') }}</p>
    <p>{{ Form::text('dob',$user->dob) }}</p>    


    <!-- submit button -->
    <p>{{ Form::submit('Update') }}</p>

{{ Form::close() }}
</div>
@stop