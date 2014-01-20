@extends('homecoming.master')
@section('content')

{{ Form::open(array('url'=>'homecoming/register/new')) }}
{{ Form::hidden('user_id',$profile->user_id,array('id'=>'user_id')) }}

<style>


.glyphicon {  margin-bottom: 10px;margin-right: 10px;}

small {
display: block;
line-height: 1.428571429;
color: #999;
}
#message { font-style:italic; }
#file { visibility:hidden;}
</style>

<div class="container">
<div class="row">
	<div class="col-md-12">
    <div class="row">
        <div class="col-xs-12 col-sm-11 col-md-10 col-md-offset-1 col-lg-10">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4" id="imageholder">
                             
                        <img src="{{$image}}" id="image" alt="" class="img-rounded img-responsive"/>
                        <div id="img"></div>   
                        <input id="file" type="file" />
                         <input type="button" id="up_photo" value="Save Picture" class="btn btn-primary" onClick="pospos();">
                        <span id="message">Please tap on thumbnail to Update Picture</span><br />
                    </div>
                    <div class="col-sm-6 col-md-8 we">
                        <h4>
                            {{ @ucfirst(strtolower($profile->last_name)) }} , {{ @ucfirst(strtolower($profile->first_name)) }}  {{ @ucfirst(@substr($profile->middle_name,0,1))  }}. </h4>

                        <small><cite title="San Francisco, USA">{{ $profile->address }} <i class="glyphicon glyphicon-map-marker">
                        </i></cite></small>
                        <p>
                            <i class="glyphicon glyphicon-barcode"></i> {{ $profile->student_id }}
                            <br />
                            <i class="glyphicon glyphicon-star-empty"></i>{{ $profile->course }}</a>
                            <br />
                            <i class="glyphicon glyphicon-pushpin"></i>{{ $profile->dob }}</p>

                            <i class="glyphicon glyphicon-user"></i>Batch : <strong> {{ date('Y',strtotime($usermeta['GraduateDate'])) }}</strong></p>
                        <!-- Split button -->
                        	<br />
									@if ($attended)
										<input type="button"  onClick=window.location="login/{{$profile->user_id}}"  value="Attended, Update?" class="btn btn-primary">
									@else
										<input type="submit" value="Attend" class="btn btn-primary"> 
									@endif		
                                        Duplicate Entry? ( <a href="/homecoming/delete/{{$profile->user_id}}">Delete User</a> )
                                     
                                      				
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<script>

    
$("#image").click(function()
{
  $("#file").click();  
});

 $("#img").click(function()
 {
    $("#file").click();  
});

 (function (global, $width, $height, $file, $message, $img) {
  
  // (C) WebReflection Mit Style License
  
  // simple FileReader detection
  if (!global.FileReader)
   // no way to do what we are trying to do ...
   return $message.innerHTML = "FileReader API not supported"
  ;
  
  // async callback, received the
  // base 64 encoded resampled image
  function resampled(data) {
   $message.innerHTML = "";
   ($img.lastChild || $img.appendChild(new Image)
   ).src = data;
   $("#image").hide();
    $("#up_photo").show();
  }
  
  // async callback, fired when the image
  // file has been loaded
  function load(e) {
   $message.innerHTML = "resampling ...";
   // see resample.js
   Resample(
     this.result,
     this._width || null,
     this._height || null,
     resampled
   );
   
  }
  
  // async callback, fired if the operation
  // is aborted ( for whatever reason )
  function abort(e) {
   $message.innerHTML = "operation aborted";
  }
  
  // async callback, fired
  // if an error occur (i.e. security)
  function error(e) {
   $message.innerHTML = "Error: " + (this.result || e);
  }
  
  // listener for the input@file onchange
  $file.addEventListener("change", function change() {
   var
    // retrieve the width in pixel
    width = 250//parseInt($width.value, 10),
    // retrieve the height in pixels
    height = 300//parseInt($height.value, 10),
    // temporary variable, different purposes
    file
   ;
   // no width and height specified
   // or both are NaN
   if (!width && !height) {
    // reset the input simply swapping it
    $file.parentNode.replaceChild(
     file = $file.cloneNode(false),
     $file
    );
    // remove the listener to avoid leaks, if any
    $file.removeEventListener("change", change, false);
    // reassign the $file DOM pointer
    // with the new input text and
    // add the change listener
    ($file = file).addEventListener("change", change, false);
    // notify user there was something wrong
    $message.innerHTML = "please specify width or height";
   } else if(
    // there is a files property
    // and this has a length greater than 0
    ($file.files || []).length &&
    // the first file in this list 
    // has an image type, hopefully
    // compatible with canvas and drawImage
    // not strictly filtered in this example
    /^image\//.test((file = $file.files[0]).type)
   ) {
    // reading action notification
    $message.innerHTML = "reading ...";
    // create a new object
    file = new FileReader;
    // assign directly events
    // as example, Chrome does not
    // inherit EventTarget yet
    // so addEventListener won't
    // work as expected
    file.onload = load;
    file.onabort = abort;
    file.onerror = error;
    // cheap and easy place to store
    // desired width and/or height
    file._width = width;
    file._height = height;
    // time to read as base 64 encoded
    // data te selected image
    file.readAsDataURL($file.files[0]);
    // it will notify onload when finished
    // An onprogress listener could be added
    // as well, not in this demo tho (I am lazy)
   } else if (file) {
    // if file variable has been created
    // during precedent checks, there is a file
    // but the type is not the expected one
    // wrong file type notification
    $message.innerHTML = "please chose an image";
   } else {
    // no file selected ... or no files at all
    // there is really nothing to do here ...
    $message.innerHTML = "nothing to do";
   }
  }, false);
 }(
  // the global object
  this,
  // all required fields ...
  document.getElementById("width"),
  document.getElementById("height"),
  document.getElementById("file"),
  document.getElementById("message"),
  document.getElementById("img")
 ));

 function pospos() {
 //  alert($('img')[1].src);
    var we = $('img')[1].src;
    var user_id = $('#user_id').val();
   // alert(user_id);
   $.ajax({
        url: "/homecoming/ct",
        type: "post",
        data: { img : we, user_id: user_id },
        success: function(){
        //   alert(we);
           // $("#result").html(we);
           location.href="  "+user_id;
        },
        error:function(){
        //    alert("failure");
            $("#result").html('There is error while submit');
        }
    });

}
 </script>



{{ Form::close() }}
@stop