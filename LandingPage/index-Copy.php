<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Navigation Bar -->
	<?php include('../NavigationBar/navigationBar.php'); ?>
	<!-- / Navigation Bar -->

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Bezal Shop</title>
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.css" >
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/owl.theme.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="style.css" >
	<link rel="stylesheet" href="css/reportContainer.css" >
	<link rel="stylesheet" href="css/responsive.css" >
	

	<!-- ------------------------------------------------------------------------------- -->
	<!-- ----------------------- Database Connection ----------------------------------- -->
	<?php
            // //database connection
            // $host = 'localhost';
            // $user = 'root';
            // $pass = '';
            // $db = '299v2';

            // //$mysqli is object of mysqli class
            // $mysqli = new mysqli($host,$user,$pass,$db); 
            $servername = "localhost";
            $username   = "root";
            $password   = "";
            $dbname     = "299v2";
            
            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

			//call query method of $mysqli object
			//SELECT queries are always return as mysqli result object
            $AllReports = $conn->query("SELECT *  FROM location l , report r, category c, images i 
                    	WHERE l.Id = r.location_Id
                        And c.Id = r.category_id
                        And i.report_Id = r.report_Id 
                        ORDER BY report_date DESC");
    ?> 
	<!-- --------------------------------------------------------------------------------- -->
	<!-- --------------------------------------------------------------------------------- -->

</head>

<body>



<!--reportProblem-->
<section id="reportProblem">

<!-- <div class="overlay"></div> -->

		
					<div class = "right" id="mapPos">
						<!-- map  -->     
						<div id="map"></div>
					</div>

					<div  class = "left" id = "reportPos"> 
						<?php while ($result = $AllReports->fetch_assoc()): ?> 

						<!-- run javascript function upon clicking container -->
						<a href = "javascript:containerClick(<?= $result['report_Id'] ?>);">
							<div class='movie-container' id = "report_container" >
								<div class='left-column'> 
									<!-- Image width and height multiplied by 1.3 (to make them a bit bigger) -->
									<img src="data:image/jpeg;base64,<?php echo base64_encode($result['image']); ?>" />
								</div>
								<div class='right-column'>
									<h3><?= $result['report_title'] ?></h3>
									<span class='date' id = 'date'> Reported on  <?=  date("M jS, Y", strtotime($result['report_date'])) ?> </span>
									<!-- <div class='content description'><! ?= $result['category_name'] ?></div> -->
								</div>
							</div>
							<script> 
							//when a container is clicked open the report
								function containerClick(reportId){
									window.open('../MarkerPage/markerPage.php/?report='+reportId,'_blank');
									console.log("in");
								}
							</script>
						</a>
						<?php endwhile; ?>
					</div>
		
</section>



<!-- footer section end-->
<footer class="text-center">
	<!-- go to top -->
	<!-- a href="#reportProblem" class="top smooth-scroll"><i class="fa fa-angle-up"></i>
		Go to top</a -->

	<div class="social-icon wow zoomIn">
		<a href="#"><i class="fa fa-facebook"></i></a>
		<a href="#"><i class="fa fa-twitter"></i></a>
		<a href="#"><i class="fa fa-google-plus"></i></a>
		<a href="#"><i class="fa fa-linkedin"></i></a>
		<a href="#"><i class="fa fa-instagram"></i></a>
	</div>
	<p>&copy; Designed by <a href="https://www.behance.net/antuhin">Shahin Srowar</a> Coded by <a href="http://readytheme.net/author/iqbalhossain/">Iqbal Hossain</a></p>
</footer>

	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/wow.min.js"></script>
	<script src="js/owl.carousel.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

	<script src="js/jquery.sticky.js"></script>
	<script src="js/main.js"></script>

	
	<!-- --------------------------------------------------------------------------------- -->
	<!-- --------------------------------------------------------------------------------- -->

	 <!-- ---------------------------- database --------------------------------- -->
	 <?php
        // $servername = "localhost";
        // $username   = "root";
        // $password   = "";
        // $dbname     = "299v2";
        
        // // Create connection
        // $conn = mysqli_connect($servername, $username, $password, $dbname);
        
        // // Check connection
        // if ($conn->connect_error) {
        //     die("Connection failed: " . $conn->connect_error);
        // }
                    
            //$retrieveLocation = $conn->query("SELECT latitude ,longitude FROM location l , report r WHERE l.Id = r.location_Id ");

            //!!!!!!!!!!!!!!!!!!!!!!!!!!!! must add citizen id later on !!!!!!!!!!!!!!!!!!!!!!!!!!!!
            $testRetrieveDescription = $conn->query("SELECT * 
                                              FROM location l , report r, category c, images i
                                              WHERE l.Id = r.location_Id
                                              And c.Id = r.category_id
                                              And i.report_Id = r.report_Id");
            
            //create arrays to store values retrieved from queries
            $latArray = array();
            $longArray = array();
            $catArray = array();
            $imgArray = array();
            $reportIdArray = array();
            $reportSummary = array();
            $userIdArray = array();
            // $reportStatus= array();
            

            
            /* store values of report fields in a different array each*/
            while ($row = $testRetrieveDescription->fetch_assoc()) {
                $reportIdArray[] = $row['report_Id']; 
                $latArray[] = $row['latitude'];
                $longArray[] = $row['longitude'];
                $reportSummary[] = $row['report_text'];
                $catArray[] = $row['category_name'];
                $imgArray[] = $row['image'];
                $userIdArray[] = $row['user_id'];
                // $reportStatus[] = $row['report_status'];
            }

            //    echo '</br> reportIdArray array length= ' . sizeOf($reportIdArray) . '</br>';
            //    print_r($reportIdArray);
        
        ?>
		 
        <!-- --------------------------------------------------------------------- -->

       

        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
    

        <script type="text/javascript">
            function initMap() {
      
                var uluru = {lat: 33.888630, lng: 35.495480};
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 10,
                    center: uluru
                });


               //retreive the lat, long, cat, img array from php and storing them in new array in js
                var reportIdArray = [<?php echo '"'.implode('","', $reportIdArray).'"' ?>];
                var latArray = [<?php echo '"'.implode('","', $latArray).'"' ?>];
                var longArray = [<?php echo '"'.implode('","', $longArray).'"' ?>];
                var catArray = [<?php echo '"'.implode('","', $catArray).'"' ?>]; 
                var reportSummary = [<?php echo '"'.implode('","', $reportSummary).'"' ?>]; 
                var userIdArray = [<?php echo '"'.implode('","', $userIdArray).'"' ?>]; 
                // var reportStatus = [<!--?php echo '"'.implode('","', $reportStatus).'"' ? -->]; 
                //var imgArray = [<!--?php echo  json_encode(array_slice($imgArray, 2)); ?-->];


                //create a 2d array and store all descriptions of reports in it
                var markerDescription = [[]];
                var i;

                for(i =0; i<longArray.length; i++){

                    //lat and long must be in the begining to use for markers
                    markerDescription[i] = [latArray[i],longArray[i], reportIdArray[i], userIdArray[i], catArray[i], reportSummary[i]];

                    console.log(markerDescription[i]);
                }
                
                console.log(markerDescription.length);

                var c;
                for (c = 0; c < markerDescription.length; c++) { 
                    console.log(markerDescription[c]); 
                    
                }
               
               //create marker for every location in markerDescription array
                var j;
                var marker = [];
                for (j = 0; j < markerDescription.length; j++) { 
                    
                        marker[j] = new google.maps.Marker({
                            animation: google.maps.Animation.DROP,
                            position: new google.maps.LatLng(markerDescription[j][0], markerDescription[j][1]),
                            id: markerDescription[j][2], //set marker id 
                            map: map
                           
                        });

                        
                        //change this array specific to this marker to JSON to pass it through URL
                        var para = JSON.stringify(markerDescription[j][2]);
                        console.log(para);

                        //content of the infowindow(popup)
                        var content = getMarkerDescription(markerDescription[j][2])    
                        var infowindow = new google.maps.InfoWindow()
                        
                            
                        google.maps.event.addListener(marker[j],'click', (function(marker,content,infowindow, para){ 
                                return function() {
                                   infowindow.setContent(content);
                                   infowindow.open(map,marker);
                                   //location.hash = para;
                                  // window.location = '../MarkerPage/markerPage.php/?params='+hash;
                                   window.open('../MarkerPage/markerPage.php/?report='+para,'_blank'); 
                                 //  window.location = '../MarkerPage/markerPage.php/?params='+para,'_blank';
                                  
                                };
                        })(marker[j], content, infowindow, para));
                       
                    

                }
                

                //returns info of marker given reportId
                var row;
                function getMarkerDescription(reportId) {
                    for(row = 0; row < marker.length; row++){
                        if (reportId == markerDescription[row][2]){
                            console.log(reportId);
                            return markerDescription[row][4] + "<br>"+ markerDescription[row][5] ;
                        }
                    }
                }

            }
        </script>

        <script async defer
             src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCB9kcH0PdYyVeYW-Ic3j7O8IbrGvHe5Jk&callback=initMap">
        </script>


		<script>
		////////////////////// change css according to screen size /////////////////////////////
		$(window).on('resize', function() {
		  var win = $(this);
		  var w;
		  if (win.width() < 800)  {

			
			$('#mapPos').addClass('top');
			$('#mapPos').removeClass('right');
			$('#reportPos').addClass('bottom');
			$('#reportPos').removeClass('left');
		

			
		  } else {
			$('#mapPos').addClass('right');
			$('#mapPos').removeClass('top');
			$('#reportPos').addClass('left');
			$('#reportPos').removeClass('bottom');
					
		  }
		}).resize(); // Invoke the resize event immediately onload</script>>













	<!-- --------------------------------------------------------------------------------- -->
	<!-- --------------------------------------------------------------------------------- -->
</body>


</html>
