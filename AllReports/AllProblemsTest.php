<!DOCTYPE html>
<html  class="js flex mobile" lang="en">
   <head>
   
      <!-- Navigation -->
      <?php include('../NavigationBar/navigationBar.php'); ?>
      <!-- /Navigation -->
	  
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
    
   </head>
   
		<!-- ---------------------------- database --------------------------------- -->
		<?php
		  
        $servername = "localhost";
        $username   = "root";
        $password   = "";
        $dbname     = "299V1";
        
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
		}
		
		// deocde the param passed in url 
		$params = json_decode($_GET['report']);
		//print_r($params);
		
		
                    
            //!!!!!!!!!!!!!!!!!!!!!!!!!!!! must add citizen id later on !!!!!!!!!!!!!!!!!!!!!!!!!!!!
            $testRetrieveDescription = $conn->query("SELECT * 
													FROM location l , report r, category c, images i
													WHERE l.Id = r.location_Id
													And c.Id = r.category_id
													And i.Id = r.image_id
													And r.report_Id = '$params'");
            
            

            
            /* store values of report fields in a different array each*/
            while ($row = $testRetrieveDescription->fetch_assoc()) {
                $reportIdArray = $row['report_Id']; 
                $latArray = $row['latitude'];
                $longArray = $row['longitude'];
                $reportSummary = $row['report_text'];
                $catArray = $row['category_name'];
                $imgArray = $row['image'];
                $userIdArray = $row['user_id'];
				$reportStatus = $row['report_status'];
				//!!!!!!!!!!!!!!!!!!!!!!!! the upvotes and downVote values are passed as </br> not 0 !!!!!!!!!!!!!!!!!!!!!!!!!
				$reportUpVote = $row['upVotes'];
				$reportDownVote = $row['downVotes'];
			}
			
			print_r($reportUpVote);

			function updateUpVotes(){
			   $upVotes = $_POST['variable'];
			   echo $upVotes;
			   $update = $conn->query("UPDATE report SET upVotes = '$upVotes' WHERE report_Id = '$params'");   
			}
        
        ?>
		 
        <!-- --------------------------------------------------------------------- -->
   
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
                           <h1><strong>Title</strong></h1>
                           <br>
                            <b>Latitude</b>
                            <textarea  name="textbox" id="markerLatitude" style="height:40%; width:50%;"></textarea><br>
                            <b>Longitude</b>
                            <textarea  name="textbox" id="markerLongitude" style="height:40%; width:50%;"></textarea><br>
                            <b>Category</b>
                            <textarea  name="textbox" id="markerCategory" style="height:40%; width:50%;"></textarea><br>
                            <b>Summary</b>
                            <textarea  name="textbox" id="markerSummary" style="height:40%; width:50%;"></textarea><br>
                            <b>Report Status</b>
                            <textarea  name="textbox" id="markerStatus" style="height:40%; width:50%;"></textarea><br>
                            <b>upvotes</b>
                            <textarea  name="textbox" id="upVote" style="height:40%; width:50%;"></textarea><br>
                            <b>downVotes</b>
                            <textarea  name="textbox" id="downVote" style="height:40%; width:50%;"></textarea><br>

                            <!-- upvote and downVote buttons -->
                            <button type="button" id="upVote" onClick="onUpVoteClick()" >Up Vote</button>
                            <button type="button" id="downVote" onClick= "onDownVoteClick()">Down Vote</button>
                            <!-- hidden fields with values of up and down vote states-->
                            <input type="text" id="upState" value ="0" style="visibility:hidden"/>
                            <input type="text" id="downState" value ="0" style="visibility:hidden"/>
                           
                        </div>
                     </div>
					 
                     <div class="row">
					 
                        <!-- ----------Report Table ------------ -->
                        <div class="col-sm-6 col-sm-offset-3 form-box reportTable" id="reporttable">
						
                           <div class="form-top">
                              <div class="form-top-left">
                                 <h3>Report your problem</h3>
								 <p>description here</p>
								 <p id="demo"></p>
                              </div>
                              <!-- image beside report a problem -->
                              <div class="form-top-right">
                                 <i class="fa fa-key"></i>
                              </div>
                           </div>
						   
							<div class="form-bottom">
                              <form role="form" action="" method="post" class="login-form" enctype="multipart/form-data">
							  
                                 <!-- ------------- Location------------------ -->
                                 <input id="pac-input" class="controls" type="text" placeholder="Search Location" style="width: 50%;"/>
								 <!-- ----------------------------------- -->
					
								 
                                 <!-- --------------- category --------------- -->
                                 <h3>Category</h3>
								  <form action ="DatabaseRP2.php" method = "post">
								  
								  
								  
									<select name = "category" style="width: 100%;" class="form-control" id="form_category" data-role="user" data-body=""> <!-- temp -->
										<option value="Street Lights"> Street Lights</option>
										<option value="Garbage"> Garbage</option>
										<option value="Traffic Lights"> Traffic Lights</option>
										<option value="Pothole"> Pothole</option>
									</select>
									 <!-- ----------------------------------- -->
									 
									 <!-- ------------- Summary ----------------- -->
									 <!--  jQuery that will add 20 pixels to the height of the box for every 50 characters you put in -->
									 <br><br>
									 <label>
									 Summarize the problem
									 </label>
									 
									 
									 <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
									 
									 <textarea class="form-control" name="textbox" id="textbox" style="height:40%; width:100%;" placeholder="Enter a summary of the problem..."></textarea>
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
									 <input type="hidden" name="upload_fileid" value="" /> <!-- temp -->
									 <!-- ----------------------------------- -->
									 
									 <!-- ---------- Adding Photos ---------- --> 
									 <br><br>
									 
									 
										 <label>	
										 Photo 
										 </label>
										 
										 <!-- attach image button -->
										 <br>
										 <button type="button" class="btn btn-default btn-lg"  id="chooseImgBtn">
											<span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
										 </button> <br>
										 <br>
										 
										 <!--this will open the file to choose pic from -->
										 <input id="i_file" type="file" style="display:none" name="image" />
										 <img id= "i_image" src="" width="25%" height="15%" style="display:none;"  />
									 
									 <!-- open file to choose img from and display it -->
									 <script>
										/////////////////////// Attach Image //////////////////////////
										$('#chooseImgBtn').bind("click" , function () {
											$('#i_file').click();
											$('#i_file').change( function(event) {
												$("#i_image").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
											});
										});
										
									 </script>
									 <!-- ---------------------------------------------- -->
									 
									 <!-- ----------------- submit button -------------- -->
									 <br> <br>
									 <!--	<button type="button" class="btn btn-default btn-lg" id="submitReportBtm"> Submit </button> <br>-->
									 <input type="hidden" id= "latitude" name="latitude" value="" />
									 <input type="hidden" id = "longitude" name="longitude" value="" />
									 <input type="submit" name="submit" value="Submit" class="btn btn-default btn-lg" />
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
    <!-- use the same array from php to get specific data -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
		<script type="text/javascript">

			//retreive the lat, long, cat, img array from php and storing them in new array in js
			var reportIdArray =  "<?php echo $reportIdArray; ?>";
			var latArray = "<?php echo $latArray; ?>";
			var longArray = "<?php echo $longArray; ?>";
			var catArray = "<?php echo $catArray; ?>";
			var reportSummary = "<?php echo $reportSummary; ?>";
			var userIdArray = "<?php echo $userIdArray; ?>";
			var reportStatus = "<?php echo $reportStatus; ?>"; 
			var reportUpVote = "<?php echo $reportUpVote; ?>";
			var reportDownVote ="<?php echo $reportDownVote; ?>"; 
			//var imgArray = "<!-- ?php echo $imgArray; ? -->";

			//window.onload = alert(localStorage.getItem("markerID"));

			// var data = <!-- ?=json_encode($params);? -->;
			document.getElementById('markerLatitude').value = latArray;
			document.getElementById('markerLongitude').value = longArray;
			document.getElementById('markerCategory').value = catArray;
			document.getElementById('markerSummary').value = reportSummary;
			document.getElementById('markerStatus').value = reportStatus;
			document.getElementById('upVote').value = reportUpVote;
			document.getElementById('downVote').value = reportDownVote;

			///////////////////////////////////////////////////////////////////////
			//make sure a user can either upVote or down vote and only once

			var upVoteBtn = document.getElementById('upVote'); 
			var downVoteBtn = document.getElementById('downVote'); 
			var upVoteState = document.getElementById('upState');
			var downVoteState = document.getElementById('downState');


			function onUpVoteClick(){
				//if both buttons are not pressed, press upvote
				if(upVoteState.value == 0 && downVoteState.value == 0){
					reportUpVote = reportUpVote + 1;
					upVoteBtn.value = reportUpVote;
					upVoteState.value = 1;

					$.ajax({
						type: 'POST',
						url: 'phpCalls.php',
						data: {'variable': reportUpVote}
					}).done(function( variable ) {
						alert( "Data Loaded: " + variable );
					});
					//<!--?php echo updateUpVotes();? -->

					console.log("clicked");}
				//if down vote button is pressed, unpress it and press upVote
				else if(upVoteState.value == 0 && downVoteState.value != 0) {
					reportUpVote = reportUpVote + 1;
					upVoteBtn.value = reportUpVote;
					upVoteState.value = 1;
					reportDownVote = reportDownVote - 1;
					downVoteBtn.value = reportDownVote;
					downVoteState.value = 0;
					console.log("clicked");
				}
				//if up vote button is pressed unpress it
				else{
					reportUpVote = reportUpVote -1;
					upVoteBtn.value = reportUpVote;
					upVoteState.value = 0;
					console.log("unclicked");
				}	
			}

			function onDownVoteClick(){
				if(downVoteState.value == 0 && upVoteState.value == 0){
					reportDownVote = reportDownVote + 1;
					downVoteBtn.value = reportDownVote;
					downVoteState.value = 1;
					console.log("clicked1");
				}
				else if(downVoteState.value == 0 && upVoteState.value != 0) {
					reportDownVote = reportDownVote + 1;
					downVoteBtn.value = reportDownVote;
					downVoteState.value = 1;
					reportUpVote = reportUpVote - 1;
					upVoteBtn.value = reportUpVote;
					upVoteState.value = 0;
					console.log("clicked2");
				}
				else{
					reportDownVote = reportDownVote -1;
					downVoteBtn.value = reportDownVote;
					downVoteState.value = 0;
					console.log("unclicked3");
				}	
			}
			///////////////////////////////////////////////////////////////////////

			
		 </script>

</html>