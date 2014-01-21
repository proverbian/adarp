@extends('layout.master')
@section('content')
<style>

body { padding-top:50px; }
.form-control { margin-bottom: 10px; }
.already_reg {
	font-size:12px;
	float:right;
}
</style>


<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-offset-4 col-md-5 well well-sm">
                @if (Session::has('email_exists'))
                    <div class="well well-sm">
                        <span class="error">Email Already Used, Please Contact Support <br />
                            Forgot Password? Click <a href="#">Here</a> 
                        </span>
                    </div>
                @endif
                @if (Session::has('email_not_same'))
                    <div class="well well-sm">
                        <span class="error">Email doesn't Match! Be Sure you Typed the same email.<br />
                        </span>
                    </divg>
                @endif
            <legend>Sign up! <p class="already_reg">Already Registered? <a href="login">Login Here</a></p></legend>
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
            <input class="form-control" name="email_confirmation" placeholder="Re-enter Email" type="email" />
            <input class="form-control" name="password" placeholder="New Password" type="password" />
            <label for="">
                Birth Date</label>
            <div class="row">
                <div class="col-xs-4 col-md-4">
                    <select class="form-control">
                        <option value="Month">Month</option>
                    </select>
                </div>
                <div class="col-xs-4 col-md-4">
                    <select class="form-control">
                        <option value="Day">Day</option>
                    </select>
                </div>
                <div class="col-xs-4 col-md-4">
                    <select class="form-control">
                        <option value="Year">Year</option>
                    </select>
                </div>
            </div>
            <label class="radio-inline">
                <input type="radio" name="sex" id="inlineCheckbox1" value="male" />
                Male
            </label>
            <label class="radio-inline">
                <input type="radio" name="sex" id="inlineCheckbox2" value="female" />
                Female
            </label>
            <br />
            <br />
            <button class="btn btn-lg btn-primary btn-block" type="submit">
                Sign up</button>
            </form>
        </div>
    </div>
</div>
@stop