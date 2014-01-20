@extends('layout.master')
@section('content')

    @if (Session::has('login_errors'))
        <span class="error">Email Already Used, Please Contact Support <br />
            Forgot Password? Click <a href="#">Here</a> 
        </span>
    @endif

<div class="container login">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="post" action="login">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">
                            Email</label>
                        <div class="col-sm-9">
                            <input type="email" name="username" class="form-control" id="inputEmail3" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">
                            Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"/>
                                    Remember me
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group last">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-success btn-sm">
                                Sign in</button>
                                 <button type="reset" class="btn btn-default btn-sm">
                                Reset</button>
                                 <div class="fb">
                                   <a href="facebook/loginfb"><img src="fb.gif" class="img-responsive"></a>
                                 </div>
                        </div>
                    </div>
                    </form>
                </div>
               
                <div class="panel-footer">
                    Not Registred? <a href="register">Register here</a>
                </div>
                
            </div>
        </div>
    </div>
</div>

@stop

@section('we')
 alert('test');
@stop