<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            @section('title')
            Adarp
            @show
        </title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="">
            <meta name="author" content="">


        <!-- CSS are placed here -->
        {{ HTML::style('css/bootstrap.css') }}
        {{ HTML::style('css/style.css') }}
        {{ HTML::style('ckeditor/contents.css') }}
        {{ HTML::style('ckeditor/bootstrap-glyphicons.css') }}


    </head>
    <body> 

    <?php
      /* $facebook = new Facebook(Config::get('facebook'));
       $uid = $facebook->getUser();
      
       if (!empty($uid)) {
         $fbdata = $facebook->api('/'.$uid); //this solveds the bug (access token bug) 
       }
       ]*/  
      // dd($uid);
      
    ?>
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
                             @if (Auth::user()->user_type == 1)
                                <li><a href="{{{ URL::to('admin') }}}">Admin</a></li>
                             @endif
                             <li><a href="{{{ URL::to('profile') }}}">Profile</a></li>
                            @else
                            <li><a href="{{{ URL::to('register') }}}">Register</a></li>
                            <li><a href="{{{ URL::to('login') }}}">Login</a></li>
                            @endif
                            
                        </ul>    
                        @if (Auth::check())
                          <ul class="nav navbar-nav navbar-right navbar-user">
                            <li class="dropdown user-dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img height="20px" width="20px" src="https://graph.facebook.com/{{$fbdata['username']}}/picture?type=small"> 
                                    {{ Auth::user()->username }} 
                                 <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                  <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                                  <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
                                  <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                                  @if (Auth::user()->is_admin)
                                    <li><a href="{{{ URL::to('admin') }}}">Admin</a></li>
                                  @endif
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
                  <!-- Content -->
                @yield('content') 
                  <!-- Content -->
                @yield('sidebar') 
        </div>



        <!-- Scripts are placed here -->
        {{ HTML::script('js/jquery-2.0.3.min.js') }}
        {{ HTML::script('js/bootstrap.js') }}

        {{ HTML::script('ckeditor/ckeditor.js') }}
        {{ HTML::script('ckeditor/styles.js') }}
        {{ HTML::script('ckeditor/config.js') }}


        <!-- Footer -->
        <div class="footer">
            @yield('footer')
        </div>
    </body>
</html>
