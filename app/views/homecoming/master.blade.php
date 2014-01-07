<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('css/bootstrap.css') }}
    {{ HTML::style('css/sb-admin.css') }}
    {{ HTML::style('css/font-awesome/css/font-awesome.min.css') }}
    {{ HTML::style('css/morris-0.4.3.min.css') }}

   
  </head>

  <body>
   

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="">
            @yield('header')
          </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
      
      </nav>
    </div>
     <div id="page-wrapper">
          @yield('content')
    </div>
    <!-- Bootstrap core JavaScript -->
   
     {{ HTML::script('js/bootstrap.js') }}


     {{ HTML::script('js/raphael-min.js') }}
     {{ HTML::script('js/morris-0.4.3.min.js') }}
     {{ HTML::script('js/morris/chart-data-morris.js') }}
     {{ HTML::script('js/tablesorter/jquery.tablesorter.js') }}
     {{ HTML::script('js/tablesorter/tables.js') }}


  </body>
</html>
