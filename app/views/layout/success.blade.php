@extends('layout.master')
@section('content')

    @if (Session::has('success_delete'))
        <span class="">Successfully Deleted!</span>
    @endif

     @if (Session::has('success_register'))
        <span class="">Successfully Registered, Email Confirmation has been sent!</span>
    @endif

     @if (Session::has('email_exists'))
        <span class="">Email Already Exists, Forgot your Password? Click Here!</span>
    @endif

     @if (Session::has('success_validation'))
        <span class="">Succesfully Validated,  Click Here to Login!</span>
    @endif

     @if (Session::has('validation_expired'))
        <span class="">Validation Expired,  Click Here to Resend Validation!</span>
    @endif

    @if (Session::has('use_valid_email'))
        <span class="">Please Use Valid Email</span>
    @endif

    

@stop