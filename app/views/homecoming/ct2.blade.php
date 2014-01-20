
 <!DOCTYPE HTML>
<html>
	<head>
	<meta name="viewport" content="width=320; user-scalable=no" />
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>ColorThief Demo</title>
	
	<script type="text/javascript" charset="utf-8" src="/jquery-2.0.2.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="/color-thief.js"></script>
        
	<style>
	#yourimage {
		width:100px;	
		width:100px;
	}
	
	#swatches {
		width: 100%;
		height: 50px;	
	}
 
	.swatch {
		width:18%;
		height: 50px;
		border-style:solid;
		border-width:thin;	
		float: left;
		margin-right: 3px;	
	}


	</style>
	</head>
 
	<body>
	<?php



	
	?>
 
		<input type="file" capture="camera" accept="image/*" id="takePictureField">
        
		<img id="yourimage">
 			
    <script>
	var desiredWidth;
 
    $(document).ready(function() {
        console.log('onReady');
		$("#takePictureField").on("change",gotPic);
		$("#yourimage").load(getSwatches);
		desiredWidth = window.innerWidth;
        
        if(!("url" in window) && ("webkitURL" in window)) {
            window.URL = window.webkitURL;   
        }
		
	});
 
	function getSwatches(){
		var colorArr = createPalette($("#yourimage"), 5);
		for (var i = 0; i < Math.min(5, colorArr.length); i++) {
			$("#swatch"+i).css("background-color","rgb("+colorArr[i][0]+","+colorArr[i][1]+","+colorArr[i][2]+")");
			console.log($("#swatch"+i).css("background-color"));
		}
	}	
	
    //Credit: https://www.youtube.com/watch?v=EPYnGFEcis4&feature=youtube_gdata_player
	function gotPic(event) {
        if(event.target.files.length == 1 && 
           event.target.files[0].type.indexOf("image/") == 0) {
         
         
         //file
          	var file = event.target.files[0]
			var imageType = /image.*/;

			if (file.type.match(imageType)) {
				var reader = new FileReader();

				reader.onload = function(e) {
					fileDisplayArea.innerHTML = "";

					var img = new Image();
					
					img.src = reader.result;
					img.id = "shiloh";
					img.style = 'height="100px" width="100px"';
					document.getElementById("dataurl").value = reader.result;
					fileDisplayArea.appendChild(img);

				}

				reader.readAsDataURL(file);	
				 
			} else {
				fileDisplayArea.innerHTML = "File not supported!";
			}
			//end file
	    }
	}


    // 'img1' is the thumbnail - I had to put an id on it
  
   function pospos() {

   	var we = document.getElementById("dataurl").value;
   $.ajax({
        url: "ct",
        type: "post",
        data: { img : we },
        success: function(){
        //   alert(we);
           // $("#result").html(we);
        },
        error:function(){
        //    alert("failure");
            $("#result").html('There is error while submit');
        }
    });

}

</script>    
	<div id="fileDisplayArea"></div>
<input type="hidden" id="dataurl">
<input type="button" onClick="pospos();">
<div id="result">

	</body>


 
</html>