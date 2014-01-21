<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard - Adarp Admin</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('css/bootstrap.css') }}
    {{ HTML::style('css/style.css') }}
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
          <a class="navbar-brand" href="/admin">Adarp Admin</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li><a href="{{ URL::to('admin/users') }}"><i class="fa fa-bar-chart-o"></i> Users</a></li>
            <li><a href="{{ URL::to('admin/reports') }}"><i class="fa fa-table"></i> Reports</a></li>
            <li><a href="news/edit"><i class="fa fa-edit"></i> Posts</a></li>
           <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Dropdown Item</a></li>
                <li><a href="#">Another Item</a></li>
                <li><a href="#">Third Item</a></li>
                <li><a href="#">Last Item</a></li>
              </ul>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
          
              <li class="dropdown user-dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 
                  {{ Auth::user()->username }} 
                 <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                  <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
                  <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                  @if (Auth::user()->is_admin)
                      <li><a href="{{{ URL::to('admin') }}}"><i class="fa fa-gear"></i> Admin</a></li>
                  @endif
                  <li class="divider"></li>
                  <li><a href="{{URL::to('logout')}}"><i class="fa fa-power-off"></i> Log Out</a></li>
                </ul>
              </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
  
    @yield('content')

    <!-- Bootstrap core JavaScript -->
     {{ HTML::script('js/jquery.js') }} <!-- 1.8.2 -->
     {{ HTML::script('js/bootstrap.js') }}

     {{ HTML::script('js/raphael-min.js') }}
     {{ HTML::script('js/morris-0.4.3.min.js') }}
     {{ HTML::script('js/morris/chart-data-morris.js') }}
     {{ HTML::script('js/tablesorter/jquery.tablesorter.js') }}
     {{ HTML::script('js/tablesorter/tables.js') }}
      

  </body>
</html>


<script>

function suspend() {
  alert('test');
}


$(document).ready(function() {


    $( "#show" ).click(function() {
      if ($("#show").text() == 'Show Quick Add') {
        $( "#quickadd" ).slideDown( "slow", function() {
          $("#show").text('Hide');
        });
      }else{
        $( "#quickadd" ).slideUp( "slow", function() {
            $("#show").text('Show Quick Add');
        });
      }
  });



  $('.btn-sm').click(function() { //Suspend
    var currentID = $(this).attr('id');
      //alert(currentID);
      if($('#'+currentID).text()=='Suspend') {
        $('#'+currentID).text('Unsuspend');
         $('#'+currentID).attr('class', 'btn btn-warning btn-sm');
            $.ajax({
              type: "POST",
              url: 'softdelete',
              data: { id : currentID, type: 'suspend' }
            });                        
      }else if($('#'+currentID).text()=='Unsuspend'){
        $('#'+currentID).text('Suspend');
        $('#'+currentID).attr('class', 'btn btn-info btn-sm');
          $.ajax({
              type: "POST",
              url: 'softdelete',
              data: { id : currentID, type: 'unsus' }
            });   
     }else if($('#'+currentID).text()=='Trash'){
        $('#'+currentID).text('Recover');
        $('#'+currentID).attr('class', 'btn btn-success btn-sm');
        $('#row'+currentID.substring(1)).attr('class', 'hide');
          $.ajax({
              type: "POST",
              url: 'softdelete',
              data: { id : currentID, type: 'trash' }
            });   
       }else if($('#'+currentID).text()=='Recover'){
        $('#'+currentID).text('Trash');
        $('#'+currentID).attr('class', 'btn btn-danger btn-sm');
          $.ajax({
              type: "POST",
              url: 'softdelete',
              data: { id : currentID, type: 'recover' }
            });   
      }

  }); 
});
</script>
