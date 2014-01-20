<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('css/homecoming.css') }}
    {{ HTML::style('bootstrap/css/bootstrap.min.css') }}


    <link rel="stylesheet" href="/css/datepicker/ui-lightness/jquery-ui-1.10.3.custom.min.css">
  <script src="/js/jquery-1.9.1.js"></script>
  <script src="/js/jquery-ui.js"></script>
  <script src="/resample.js"></script>
<script>



  


 $(function() {
    
    $( "div.raff_holder" ).hide();
    
    $("div.loading").show(function() {
        $("#raffle").hide();
        $( "div.loading" ).fadeOut(3000,function() {
          $( "div.raff_holder" ).fadeIn( 500 ,function(){
            $("#raffle").show();
         });
     });
    });


 
 
  
  // Remove Adddress Bar Ipad
  var a=document.getElementsByTagName("a");
  for(var i=0;i<a.length;i++) {
      if(!a[i].onclick && a[i].getAttribute("target") != "_blank") {
          a[i].onclick=function() {
                  window.location=this.getAttribute("href");
                  return false; 
          }
      }
  }


  $("#up_photo").hide();

  //END remove AddressBar Ipad


    $( "#accordion" ).accordion({
      collapsible: true
    });
  });

  $(function() {
     $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      yearRange: '1901:2013',
      showButtonPanel: true
    });
     $( "#datepicker2" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd",
      yearRange: '1901:2013',
      showButtonPanel: true
    });
  });
  </script>
<style>


body { 
  background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAmUlEQVQYV12Q2wrEIAxEVaSI+P/f6JMPIkWk1OUEpmwrSEicW/S11n0ch1trOWqM0V3X9erP83S+tbZ55HwBmlF9733DSCmZ2n3fD4HZnNPlnJ3/WisCMXAIIVg1RQ2wQBFlXAADRNUUSykWnosNRB052DJqxAaMokjMX1vLTl+Eqr7OMpKLHP+ZBNDmlpEGMI9jjMdSSxHhB0QBnc28Jnb5AAAAAElFTkSuQmCC);
}



.btn_raffle { margin:0 auto;width:200px;height:100px;}
.center { margin:0 auto;width:200px;height:100px;}
.loadingn {margin-top:60px;}
.clear {clear:both;}
.nopar { font-size:50px; margin:60px auto;width:460px;}
#raffle {
  margin-top:60px;
  width:200px;
  height:100px;
  font-size:30px;
}
.container { 
  background: url('') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}


 body .home-nav a{
   color:#FFF;
  

 }

.home-nav div{
   color:#FFF;
}

.home{
     background: url('/images/home.png') no-repeat center; 
     background-position:50% 22%;
}

.reports{
     background: url('/images/report.png') no-repeat center; 
     background-position:50% 22%;
}

.att{
     background: url('/images/attendance.png') no-repeat center; 
     background-position:50% 22%;
}

 .home-nav {
color: #222;
text-shadow: 0px 2px 3px #555 !important;
}
.form-control { margin-bottom: 10px; }
.already_reg {
  font-size:12px;
  float:right;
}
.home-nav div { padding:40px 40px 20px 40px ;font-weight:bold;text-align:center;background-color:#A53D3D;font-size:30px;border-bottom:solid thin #ccc; }

#search_person {height:100px;font-size:42px;margin-top:15%;}
.ui-corner-all {font-size:28px !important}
.container { padding-top:20px;}
.home-footer {
  text-align:center;
  height:50px;
  background-color:#CCC;
  border-top:solid thin #000;
  position:fixed;
  bottom:1px;
  left:1px;
  width:100%;
}

.home-footer div div  {
  padding:10px;
}
.center-text {text-align:center;}
.clear {clear:both;}
#page-wrapper { margin-bottom:50px !important;}

</style>
  </head>

<?php

$uri = Request::path();

?>
  <body> 
 <div class="row home-nav">
 @if ($uri == 'homecoming/raffle')


    <div class="col-md-12">
       Foundation University Alumni Raffle
    </div>


 @else

 <a href="/homecoming">
    <div class="col-md-4 col-sm-4 home">
       HOME
    </div>
  </a>

  <a href="{{URL::to('homecoming/attendance/2013')}}">
    <div class="col-md-4 col-sm-4 att">
      ATTENDANCE
    </div>
  </a>

  <a href="{{URL::to('homecoming/report/statistics')}}">
    <div class="col-md-4 col-sm-4 reports">
       REPORTS
    </div>
  </a>

  @endif 
 </div> 
    <div class="border-bottom"></div>

     <div id="page-wrapper">
          @yield('content')
    </div>
    <!-- Bootstrap core JavaScript -->
       @yield('raffle_button')

    {{ HTML::script('bootstrap/js/bootstrap.min.js') }}
  </body>
</html>
