
<!DOCTYPE html>
<html>
    <head>
        <title>
            @section('title')
            Adarp
            @show
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS are placed here -->
        {{ HTML::style('css/bootstrap.css') }}
        {{ HTML::style('css/style.css') }}
        {{ HTML::style('ckeditor/contents.css') }}

      
    </head>

    <body> 
        <!-- Navbar -->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="/">ADARP</a>
                </div>
                    <!-- Everything you want hidden at 940px or less, place within here -->
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            @if (Auth::check()) 
                            <li><a href="{{{ URL::to('dashboard') }}}">Dashboard</a></li>
                            <li><a href="{{{ URL::to('admin') }}}">Admin</a></li>
                             <li><a href="{{{ URL::to('profile') }}}">Profile</a></li>
                            @else
                            <li><a href="{{{ URL::to('register') }}}">Register</a></li>
                            <li><a href="{{{ URL::to('login') }}}">Login</a></li>
                            @endif
                        </ul> 
                            
                        @if (Auth::check())
                          <ul class="nav navbar-nav navbar-right navbar-user">
                            <li class="dropdown user-dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                                    {{ Auth::user()->username }} 
                                 <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                  <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                                  <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
                                  <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                                  <li class="divider"></li>
                                  <li><a href="{{ URL::to('logout') }}"><i class="fa fa-power-off"></i> Log Out</a></li>
                                </ul>
                              </li>
                          </ul>
                        @endif
                    </div>  <!-- navbar collapse -->
            </div>
        </div> 

        <!-- Container -->
        <div class="container">
            <div class="col-xs-12 col-sm-10 col-md-9 col-lg-9">       
                  <!-- Content -->
                @yield('content') 
            </div>

             <div class="col-xs-12 col-sm-2 col-md-3 col-lg-3">       
                  <!-- Content -->
                @yield('sidebar') 
            </div>
        </div>



        <!-- Scripts are placed here -->
        {{ HTML::script('js/jquery-2.0.3.min.js') }}
        {{ HTML::script('js/bootstrap.min.js') }}

        {{ HTML::script('ckeditor/ckeditor.js') }}
        {{ HTML::script('ckeditor/styles.js') }}
        {{ HTML::script('ckeditor/config.js') }}

        <!-- Footer -->
        <div class="footer">
            @yield('footer')
        </div>
    </body>
</html>
