@extends('homecoming.master')
@section('content')

@if (Session::has('create_user_success'))
   <div class="alert alert-success">Added New User!</div>
@endif
@if (Session::has('dupe'))
   <div class="alert alert-success center">It seems that you already registered. Please ask for assistance to update your Profile.</div>
@endif

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 well well-sm">
            <legend>Create New User</legend>
            <form action="#" method="post" class="form" role="form">
            <div class="row">
                <div class="col-xs-6 col-md-6">
                    <input class="form-control" name="first_name" placeholder="First Name" type="text"
                        required autofocus />
                </div>
                <div class="col-xs-6 col-md-6">
                    <input class="form-control" name="last_name" placeholder="Last Name" type="text" required />
                </div>
            </div>
            <input class="form-control" name="email" placeholder="Your Email" type="email" />
            <input class="form-control" name="reenteremail" placeholder="Re-enter Email" type="email" />
            <input class="form-control" name="password" placeholder="New Password" type="password" />
            <label for="">
                Birth Date</label>
            <div class="row">
                <div class="col-xs-3  col-md-3">
                 <p><input type="text" class="form-control" id="datepicker" placeholder="Birth Date" readonly></p>
                   
                </div>
            </div>
            <label class="radio-inline">
                <input type="radio" name="gender" id="inlineCheckbox1" value="M" />
                Male
            </label>
            <label class="radio-inline">
                <input type="radio" name="gender" id="inlineCheckbox2" value="F" />
                Female
            </label>
            <br />
            <br />
            <button class="btn btn-lg btn-primary btn-block" type="submit">
                Create!</button>
            </form>
        </div>
    </div>
</div>

@stop