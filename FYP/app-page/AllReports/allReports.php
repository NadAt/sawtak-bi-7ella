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

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

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

         <!--------------------------- database ------------------------------------------>
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
                    
            $retrieveLocation = $conn->query("SELECT latitude ,longitude FROM location l , report r WHERE l.Id = r.location_Id ");

            $re1 = array();
            $re2 = array();
          
        
            /* it was storing one value at a time and replacing that value next time around*/
            /* now arrays $re1 and $re2 store all values given*/
            while ($row = $retrieveLocation->fetch_assoc()) {
               /* $re1[] = explode(" ", $row['latitude']);
                $re2[] = explode(" ", $row['longitude']);*/
                $re1[] = $row['latitude'];
                $re2[] = $row['longitude'];
            }

            echo 're1 array length= ' . sizeOf($re1) . '</br>';
            print_r($re1);

            echo '</br> re2 array length= ' . sizeOf($re2) . '</br>';
            print_r($re2);
        
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


               //retreive the lat and long array from php and storing them in new array in js
                var latArray = [<?php echo '"'.implode('","', $re1).'"' ?>];
                var longArray = [<?php echo '"'.implode('","', $re2).'"' ?>];
                //create a 2d array and store each lat with it's long
                var markerPosition = [[]];
                var temp = [];
                var text2 = "";
                var text1 = "";
                var i;
                for(i =0; i<longArray.length; i++){
                    text1 += longArray[i] +" --- ";
                    text2 += latArray[i] +" --- ";

                    temp[0] = latArray[i];
                    temp[1] = longArray[i];

                    markerPosition[i] = [latArray[i],longArray[i]];

                    console.log(markerPosition[i]);
                }
                
                console.log(markerPosition.length);
                //markerPosition is only storing the last position??????????????
                var c;
                for (c = 0; c < markerPosition.length; c++) { 
                    console.log(markerPosition[c]); 
                    
                }
               
               //create marker for every location in markerPosition array
               //!!!!!!!!!!!!!!!!!!! only showing the last location stored !!!!!!!!!!!
               var j;
               console.log(markerPosition[0][0]); 
                for (j = 0; j < markerPosition.length; j++) { 
                    console.log(markerPosition[j]); 
                   var marker = new google.maps.Marker({
                        animation: google.maps.Animation.DROP,
                        position: new google.maps.LatLng(markerPosition[j][0], markerPosition[j][1]),
                        map: map
                    });
                    
                }
                

                



            }
        </script>

        <script async defer
             src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCB9kcH0PdYyVeYW-Ic3j7O8IbrGvHe5Jk&callback=initMap">
        </script>
   
  
    </body>

</html>