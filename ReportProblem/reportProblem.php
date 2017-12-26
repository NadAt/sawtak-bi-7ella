<!DOCTYPE html>
<html  class="js flex mobile" lang="en">
   <head>
   
      <!-- Navigation -->
      <?php include('../NavigationBar/navigationBar.php'); ?>
	  <!-- /Navigation -->
	  <!-- <!?php include('../TestDropzone/index.php'); ?> -->
	  <!-- not included inside the form -->

      <?php include 'DatabaseRP1.php';?>
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
	  
      <!-- Favicon and touch icons -->
      <link rel="shortcut icon" href="assets/ico/favicon.png">
      <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	  

	  <!-- for drop zone -->
	  <!-- <link href="css/dropzone.css" type="text/css" rel="stylesheet" />
		<script src="dropzone.min.js"></script> -->
		<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.css" rel="stylesheet" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/basic.min.css" rel="stylesheet" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script> -->
		
		<script src="assets/js/jquery-1.11.1.min.js"></script>
		<script src="css/dropzone.js"></script>
		<script src="assets/js/scripts.js"></script>
	  
	  
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
                           
                        </div>
                     </div>
					 
                     <div class="row">
					 
                        <!-- ----------Report Table ------------ -->
                        <div class="col-sm-8 col-sm-offset-3 form-box reportTable" id="reporttable">
						
                           <div class="form-top">
                              <div class="form-top-left">
                                 <h3>Report your problem</h3>
								 <!-- <p>description here</p> -->
								 <p id="demo"></p>
                              </div>
                              <!-- image beside report a problem -->
                              <!-- <div class="form-top-right">
                                 <i class="fa fa-key"></i>
                              </div> -->
                           </div>
						   
							<div class="form-bottom">
                              <form role="form" action="" method="post" class="login-form" enctype="multipart/form-data">
							  
                                 <!-- ------------- Location------------------ -->
                                 <input id="pac-input" class="controls" type="text" placeholder="Search Location" style="width: 50%;"/>
								 <!-- ----------------------------------- -->
					
								 
                                 <!-- --------------- Title --------------- -->
                                 
								  <form action ="DatabaseRP1.php" method = "post">
								  
 									<label>
									<h3> Title</h3>
									</label>
									 
								
									 <textarea class="form-control" maxlength="30" name="titleTextbox" style="height:20%;" placeholder="Enter a summary of the problem..."></textarea>
									 
								  <!-- --------------- category --------------- -->
								  <br>
								  	<h3>Category</h3>
									<select name = "category" style="width: 100%;" class="form-control" id="form_category" data-role="user" data-body=""> <!-- temp -->
										<option value="Street Lights"> Street Lights</option>
										<option value="Garbage"> Garbage</option>
										<option value="Traffic Lights"> Traffic Lights</option>
										<option value="Pothole"> Pothole</option>
									</select>
									 <!-- ----------------------------------- -->
									 
									 <!-- ------------- Summary ----------------- -->
									 <!--  jQuery that will add 20 pixels to the height of the box for every 50 characters you put in -->
									 <br>
									 <label>
									 <h3> Write what's wrong </h3>
									 </label>
									 
									 
									 <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
									 
									 <textarea class="form-control" name="textbox" id="textbox" style="height:40%; width:100%;" placeholder="Explain what's wrong..."></textarea>
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
									 <!-- <input type="hidden" name="upload_fileid" value="" /> temp -->
									 <!-- ----------------------------------- -->
									 
									 <!-- ---------- Adding Photos ---------- --> 
									 	 <br>
										 <label>	
										 <h3>Include an Image</h3>
										 </label>
									   
										 
										 <!-- attach image button -->
										 <br>
										 <button type="button" class="btn btn-default btn-lg"  id="chooseImgBtn">
											<span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
										 </button> <br>
										 <br>

										 <!--this will open the file to choose pic from -->
                                         <input type="file" multiple id="files" style="display:none" name ="image[]">
										 <div id="preview"></div>
										 

										 <!-- open big image on click -->
										 <!-- <div id="overlay"></div>
										 <div id="overlayContent">
											<img id="imgBig" src="" alt="" width="400" />
										 </div> -->
										 
									 <!-- open file to choose img from and display it -->
									 <script>
										/////////////////////// Attach Image //////////////////////////
										var source = "";
										$('#chooseImgBtn').bind("click" , function () {
											$('#files').click();
											$('#files').change( function(event) {
												source = URL.createObjectURL(event.target.files[0]);
												// console.log(source);
												$("#i_image").fadeIn("fast").attr('src', source);
											});
										});

										function handleFileSelect(event){
												// console.log(event)
												var input = this;
												if (input.files){

													var filesAmount = input.files.length;

													for (i = 0; i < filesAmount; i++) {
														var reader = new FileReader();
														console.log(reader)
														reader.onload = (function(e){
																var span = document.createElement('span');
																span.innerHTML = ['<img class="thumb" src="', e.target.result, '" title="', escape(e.name), '" width="100" height="100"/><span class="remove_img_preview"></span>'].join('');
																document.getElementById('preview').insertBefore(span, null);
														});

														reader.readAsDataURL(input.files[i]);

													}
												}
											}
											$('#files').change(handleFileSelect);
											$('#preview').on('click', '.remove_img_preview', function(){
													$(this).parent('span').remove();
													$(this).val("");
											});

										// $("#i_image").bind("click" , function(){
										// 	console.log("img clicked");		                                 
										// 	$("#imgBig").attr("src",source);
										// 	$("#overlay").show();
										// 	$("#overlayContent").show();

										// });

										// $("#imgBig").click(function(){
										// 	$("#imgBig").attr("src", "");
										// 	$("#overlay").hide();
										// 	$("#overlayContent").hide();
										// });
										
									 </script>
									 <!-- ---------------------------------------------- -->
									 
									 <!-- ----------------- submit button -------------- -->
									 <br> <br>
									 <!--	<button type="button" class="btn btn-default btn-lg" id="submitReportBtm"> Submit </button> <br>-->
									 <input type="hidden" id= "latitude" name="latitude" value="" />
									 <input type="hidden" id = "longitude" name="longitude" value="" />
									 <input type="submit" name="submit" value="Submit" class="btn btn-default btn-lg"/>
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
         src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCB9kcH0PdYyVeYW-Ic3j7O8IbrGvHe5Jk&libraries=places&callback=initMap" async defer></script>
    <script type="text/javascript">
	  
        var map;
        var currentLocation;
        var currentLatitude;
        var currentLongitude;
         
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
					var currnetLocation = position.name;
					var lat = position.coords.latitude;
					var lng = position.coords.longitude;
					map.setCenter(new google.maps.LatLng(lat, lng));
			 
					currentLocation = { lat: currentLatitude, lng: currentLongitude };
			 
					var infowindow = new google.maps.InfoWindow({
						content: currnetLocation 
					});
			   
			 
					markers = new google.maps.Marker({
						position: currentLocation,
						map: map,
						title: position.name
					});
					 
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
						document.getElementById("latitude").value = currentLatitude;
						document.getElementById("longitude").value = currentLongitude;
						map.setCenter(new google.maps.LatLng(currentLatitude, currentLongitude));
						
						// Create a marker for each place.
					 
					
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

			setTimeout(function() {
				document.getElementById("latitude").value = currentLatitude;
				document.getElementById("longitude").value = currentLongitude;
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
		}).resize(); // Invoke the resize event immediately onload
	
				
	</script>
    <!-- google maps API:  AIzaSyCB9kcH0PdYyVeYW-Ic3j7O8IbrGvHe5Jk   -->
</html>