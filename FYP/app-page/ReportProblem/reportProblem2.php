<!DOCTYPE html>
<html  class="js flex mobile" lang="en">
   <head>
   
      <!-- Navigation -->
      <?php include('../NavigationBar/navigationBar.php'); ?>
      <!-- /Navigation -->
	  
      <?php include 'DatabaseRp1.php';?>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Bootstrap Login Form Template</title>
	  
      <!-- CSS -->
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3mobile.css">
      <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
      <link rel="stylesheet" href="assets/bootstrap/css/bootstrapRP.min.css">
      <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/form-elements.css">
      <link rel="stylesheet" href="assets/css/styleReportProblem.css">
	  
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
	  
      <!-- Favicon and touch icons -->
      <link rel="shortcut icon" href="assets/ico/favicon.png">
      <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
      <!--link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
         <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
         <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
         <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png"-->
		 
   </head>
   
   <body>
      <div class="wrapper">
		 <!-- map -->
         <div class="right" id="mapPos">
            <div id="map"></div>
         </div>
		 
         <!-- Top content -->
         <div class="left" id="reportPos" >
            <div class="top-content">
               <div class="inner-bg">
                  <div class="container">
				  
                     <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text reportText" id="reporttext">
                           <h1><strong>Report</strong>  A Problem</h1>
                           <div class="description">
                              <p>
                                 This is a free responsive login form made with Bootstrap. 
                                 Download it on <a href="http://azmind.com"><strong>AZMIND</strong></a>, customize and use it as you like!
                              </p>
                           </div>
                        </div>
                     </div>
					 
                     <div class="row">
					 
                        <!-- ----------Report Table ------------ -->
                        <div class="col-sm-6 col-sm-offset-3 form-box reportTable" id="reporttable">
						
                           <div class="form-top">
                              <div class="form-top-left">
                                 <h3>Report your problem</h3>
                                 <p>description here</p>
                              </div>
                              <!-- image beside report a problem -->
                              <div class="form-top-right">
                                 <i class="fa fa-key"></i>
                              </div>
                           </div>
						   
							<div class="form-bottom">
                              <form role="form" action="" method="post" class="login-form">
							  
                                 <!-- ------------- Location------------------ -->
                                 <input id="pac-input" class="controls" type="text" placeholder="Search Location" style="width: 85%;">
								 <!-- ----------------------------------- -->
								 
                                 <!-- --------------- category --------------- -->
                                 <h3>Category</h3>
								  <form action ="DatabaseRP1.php" method = "post" >
								  
									<select name = "category" style="width: 85%;" >
										<option value="	Street Lights	"> Street Lights</option>
										<option value="	Garbage		"> Garbage</option>
										<option value="	Traffic Lights	"> Traffic Lights</option>
										<option value="Pothole"> Pothole</option>
									</select>
									 <!-- ----------------------------------- -->
									 
									 <!-- ------------- Summary ----------------- -->
									 <!--  jQuery that will add 20 pixels to the height of the box for every 50 characters you put in -->
									 <br>
									 <label>
									 Summarize the problem
									 </label>
									 
									 <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
									 <textarea id="textbox" name = "textbox" style="height:40;width:85%;"></textarea>
									 <script type="text/javascript">
										$(document).ready(function() {
											$("#textbox").val('');
											$("#textbox").keypress(function() {
												var textLength = $("#textbox").val().length;
												if (textLength % 50 == 0) {
													var height = textLength/50;
													$("#textbox").css('height', (40+(height*20)));
												}
											});
										});
									 </script>
									 <!-- ----------------------------------- -->
									 
									 <!-- ---------- Adding Photos ---------- --> 
									 <br><br>
									 
									 <label>	
									 Photo 
									 </label>
									 
									 <!-- attach image button -->
									 <br>
									 <button type="button" class="btn"  id="chooseImgBtn">
									 <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
									 </button>
									 
									 <!-- open camera button -->
									 <!-- adding video and canvas for camera -->
									 <video id="video" width="50" height="50" autoplay></video>
									 <button type="button" class="btn btn-default btn-lg" id="openCamBtn">
									 <span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
									 </button> <br> 
									 <canvas id="canvas" width="50" height="50"></canvas>
									 
									 <br> <br>
									 
									 <!--this will open the file to choose pic from -->
									 <input id="i_file" type="file" style="display:none" />
									 <img id= "i_img" src="" width="100" style="display:none;" />
									 
									 <!--this will open camera -->
									 <input id="camBtn" type="file" accept="image/*;capture=camera" style="display:none">
									 
									 <!-- open file to choose img from and display it -->
									 <script>
										/////////////////////// Attach Image //////////////////////////
										$('#chooseImgBtn').bind("click" , function () {
										$('#i_file').click();
										$('#i_file').change( function(event) {
										$("#i_img").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
										});
										});
										
										/////////////////////// Snap Photo //////////////////////////
										// Grab elements, create settings, etc.
										  var video = document.getElementById('video');
										
										  // Get access to the camera!
										  if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
											  // Not adding `{ audio: true }` since we only want video now
											  navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
												  video.src = window.URL.createObjectURL(stream);
												  video.play();
											  });
										  }
										  // Elements for taking the snapshot
										  var canvas = document.getElementById('canvas');
										  var context = canvas.getContext('2d');
										  var video = document.getElementById('video');
										
										  // Trigger photo take
										  document.getElementById("openCamBtn").addEventListener("click", function() {
											context.drawImage(video, 0, 0, 640, 480);
										  });
									 </script>
									 <!-- ---------------------------------------------- -->
									 
									 <!-- ----------------- submit button -------------- -->
									 <br>
									 <!--	<button type="button" class="btn btn-default btn-lg" id="submitReportBtm"> Submit </button> <br>-->
									 <input type="hidden" id= "latitude" name="latitude" value="">
									 <input type="hidden" id = "longitude" name="longitude" value="">
									 <input type="hidden" id = "address" name="address" value="">
									 <input type="submit" name="submit" value="Submit">
									 <!-- ---------------------------------------------- -->
									 
								  </form>
                              </form>
							  
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div> 
      <!-- Javascript -->
      <script src="assets/js/jquery-1.11.1.min.js"></script>
      <script src="assets/bootstrap/js/bootstrap.min.js"></script>
      <script src="assets/js/jquery.backstretch.min.js"></script>
      <script src="assets/js/scripts.js"></script>
      <!--[if lt IE 10]>
      <script src="assets/js/placeholder.js"></script>
      <![endif]-->
      <script
         src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCB9kcH0PdYyVeYW-Ic3j7O8IbrGvHe5Jk&libraries=places&sesror=true&callback=initMap" async defer></script>
    <script type="text/javascript">
	  
        var map;
        var currentLocation;
        var currentLatitude;
        var currentLongitude;
        var currnetLocation;
		var address;
        function initMap() {
         
			map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: -33.8688, lng: 151.2195},
				zoom: 13,
				mapTypeId: 'roadmap'
			});
			 
			 
         
			var markers=[];
			 
			if ("geolocation" in navigator){
         
				navigator.geolocation.getCurrentPosition(function(position){ 
					currentLatitude = position.coords.latitude;
					currentLongitude = position.coords.longitude;
				    address = position.name;
					var lat = position.coords.latitude;
					var lng = position.coords.longitude;
					map.setCenter(new google.maps.LatLng(lat, lng));
			 
					currentLocation = { lat: currentLatitude, lng: currentLongitude };
			 
					var infowindow = new google.maps.InfoWindow({
						content: address 
					});
			   
			 
					markers = new google.maps.Marker({
						position: currentLocation,
						map: map,
						title: position.name
					});
					
					console.log(position.formatted_address);

					 
					markers.addListener('click', function() {
						infowindow.open(map, marker);
					});
				 
				});
			}
				          
         
			// Create the search box and link it to the UI element.
			var input = document.getElementById('pac-input');
			var searchBox = new google.maps.places.SearchBox(input);
			map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
         
			// Bias the SearchBox results towards current map's viewport.
			map.addListener('bounds_changed', function() {
				searchBox.setBounds(map.getBounds());
			});
         
         
			// Listen for the event fired when the user selects a prediction and retrieve
			// more details for that place.
			searchBox.addListener('places_changed', function() {
         
					// markers.setMap(null);
					markers.setMap(null);
						  
					var places = searchBox.getPlaces();
				 
					if (places.length == 0) {
						return;
					}
				 
				 
					// For each place, get the icon, name and location.
					var bounds = new google.maps.LatLngBounds();
				 
				   
					places.forEach(function(place) {
						if (!place.geometry) {
							console.log("Returned place contains no geometry");
							return;
						}
					 
						currentLocation = place.geometry.location;
						currentLatitude = place.geometry.location.lat();
						currentLongitude = place.geometry.location.lng();
						map.setCenter(new google.maps.LatLng(currentLatitude, currentLongitude));
						
						// Create a marker for each place.
					 
					    address = place.formatted_address;
					 
						markers.push(new google.maps.Marker({
							map: map,
							title: place.name,
							position: place.geometry.location,
							draggable : true         
						}));
					 
						map.setCenter(new google.maps.LatLng(currentLatitude, currentLongitude));
					 
					
						markers.forEach(function(marker) {
							marker.setMap(null);
						});
					 
						markers = [];
					 
						if (place.geometry.viewport) {
							
							// Only geocodes have viewport.
							bounds.union(place.geometry.viewport);
					 
						} else {
					 
							bounds.extend(place.geometry.location);
					 
						}
					});
				 
					map.fitBounds(bounds);
				
			});
         
			// setTimeout(function() {document.getElementById("latitude").value = currentLatitude, });
			// document.getElementById("latitude").value = currentLatitude;
			// console.log(currentLatitude);
			 
			setTimeout(function() {
				document.getElementById("latitude").value = currentLatitude;
				document.getElementById("longitude").value = currentLongitude;
				document.getElementById("address").value = address;
			}, 6000);
			 	 
		}
		
		////////////////////// change css according to screen size /////////////////////////////
		$(window).on('resize', function() {
		  var win = $(this);
		  var w;
		  if (win.width() < 800)  {

			
			$('#mapPos').addClass('top');
			$('#mapPos').removeClass('right');
			$('#reportPos').addClass('bottom');
			$('#reportPos').removeClass('left');
			$('#reporttable').addClass('reportTable');
			$('#reporttext').addClass('reportText');
			
			//set width of reportTable and reportText to window's width
			w = $(window).width();
			$('.reportTable').css('width', w);
			$('.reportText').css('width', w);

			
		  } else {
			$('#mapPos').addClass('right');
			$('#mapPos').removeClass('top');
			$('#reportPos').addClass('left');
			$('#reportPos').removeClass('bottom');
			
			//set width of reportTable and reportText to 0.3* window's width
			w = $(window).width();
			$('.reportTable').css('width', (0.3*w));
			$('.reportText').css('width', (0.3*w));
			
		  }

		});
	
				
    </script>
    <!-- google maps API:  AIzaSyCB9kcH0PdYyVeYW-Ic3j7O8IbrGvHe5Jk   -->
</html>