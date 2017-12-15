<!DOCTYPE html>
<html lang="en">

    <head>
	
	<!-- Navigation -->
	<?php include('../NavigationBar/navigationBar.php'); ?>
	<!-- /Navigation -->

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap Login Form Template</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>
        
    <body>

        <!-- map  -->     
        <style>
            #map {
                height: 400px;
                width: 100%;
            }       
        </style>
        <div id="map"></div>
        

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
                    
            //$retrieveLocation = $conn->query("SELECT latitude ,longitude FROM location l , report r WHERE l.Id = r.location_Id ");

            //!!!!!!!!!!!!!!!!!!!!!!!!!!!! must add citizen id later on !!!!!!!!!!!!!!!!!!!!!!!!!!!!
            $testRetrieveDescription = $conn->query("SELECT * 
                                              FROM location l , report r, category c, images i
                                              WHERE l.Id = r.location_Id
                                              And c.Id = r.category_id
                                              And i.Id = r.image_id");
            
            //create arrays to store values retrieved from queries
            $latArray = array();
            $longArray = array();
            $catArray = array();
            $imgArray = array();
            $reportIdArray = array();
            $reportSummary = array();
            $userIdArray = array();
            $reportStatus= array();
            

            
            /* store values of report fields in a different array each*/
            while ($row = $testRetrieveDescription->fetch_assoc()) {
                $reportIdArray[] = $row['report_Id']; 
                $latArray[] = $row['latitude'];
                $longArray[] = $row['longitude'];
                $reportSummary[] = $row['report_text'];
                $catArray[] = $row['category_name'];
                $imgArray[] = $row['image'];
                $userIdArray[] = $row['user_id'];
                $reportStatus[] = $row['report_status'];
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
                var reportStatus = [<?php echo '"'.implode('","', $reportStatus).'"' ?>]; 
                //var imgArray = [<!--?php echo  json_encode(array_slice($imgArray, 2)); ?-->];


                //create a 2d array and store all descriptions of reports in it
                var markerDescription = [[]];
                var i;

                for(i =0; i<longArray.length; i++){

                    //lat and long must be in the begining to use for markers
                    markerDescription[i] = [latArray[i],longArray[i], reportIdArray[i], userIdArray[i], catArray[i], reportSummary[i], reportStatus[i]];

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
   
  
    </body>

</html>