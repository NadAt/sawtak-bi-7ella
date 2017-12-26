<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">

	<title>FYP</title>

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	
	<!-- Main css -->
	<link rel="stylesheet" href="css/main.css">

</head>

<body>

<!-- Navigation section  -->

<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
	
		<div class="navbar-header">
			<a class="navbar-brand" href="#">FYP</a>
        </div>
		<div class="collapse navbar-collapse">
               <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.html">Home</a></li>
					<li ><a href="contactUs.html">ContactUs</a><li>
					<li class="active"><a href="adminSide.html">AdminSide</a><li>
               </ul>
          </div>
		
	</div>
</div>



<!-- main section -->
<br><br><br><br><br><br><br>


<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs">
      <h2>Welcome Admin!</h2>
      <ul class="nav nav-pills nav-stacked">
        <li ><a href="homeAdmin.html">Home</a></li>
        <li class="active"><a href="prepareMaps.php">PrepareMaps</a></li>
        <!-- <li><a href="analytics.php">Analytics/Statistics</a></li> -->
        <li><a href="profile.html">Profile</a></li>
      </ul><br>
    </div>
    <br>
    
    <div class="col-sm-9">
	
		<div class="row">
			
			<div class="col-sm-12">
			    <div class="well">
					<h2> Filter All </h2>
					<form action="exportAll.php" method='post' name='value'>
						<select class="form-control" name="exportLocation">
							<option value="" selected="selected"> Choose Location</option>
							<option value="Antelias - Bikfaiya Rd"> Antelias - Bikfaiya Rd </option>
							<option value="Zouq Mosbeh"> Zouq Mosbeh </option>
							<option value="Old Saida Rd"> Old Saida Rd </option>
							<option value="Makdisi Bayrut"> Makdisi Bayrut </option>
						</select><br/>
						
						<select class="form-control" name="exportCategory">
							<option value="" selected="selected"> Choose Category</option>
							<option value="Street Lights"> Street Lights </option>
							<option value="Garbage"> Garbage </option>
							<option value="Traffic Lights"> Traffic Lights </option>
							<option value="Pothole"> Pothole </option>
						</select><br/>
						Enter the start date:(YYYY-MM-DD)<br/>
						<input name="startDate1" type="date"><br/>
						Enter the end date:(YYYY-MM-DD) <br/>
						<input name="endDate1" type="date">
						<input type='submit' value='filter'>
					</form>
			    </div>
			</div>
			
		</div>

	<?php
			/* Attempt MySQL server connection. Assuming you are running MySQL
			server with default setting (user 'root' with no password) */
			$server = mysqli_connect("localhost", "root", "", "299v2");
			$result = mysqli_query($server, "select * from report");
			$retrieveLocationOfAll = mysqli_query($server, "SELECT location.latitude ,location.longitude, report.approved FROM location inner join report on location.Id = report.location_id where approved = 1");
			
			$re1 = array();
			$re2 = array();
			
			while ($row = mysqli_fetch_array($retrieveLocationOfAll)) {
				$re1[] = $row['latitude'];
				$re2[] = $row['longitude'];
			}
		
          
			
		?>
		
		<br/>
		
		<div id="googleMap" style="width:100%;height:700px;"></div>
		<script>
		
		
			function myMap() {
			var mapProp= {
				center:new google.maps.LatLng(33.8938,35.5518),
				zoom:11,
				mapTypeId: google.maps.MapTypeId.HYBRID
			};
			var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
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
			
			var c;
            for (c = 0; c < markerPosition.length; c++) { 
                console.log(markerPosition[c]);          
            }
			
			var j;
			var markers = [];
            console.log(markerPosition[0][0]); 
            for (j = 0; j < markerPosition.length; j++) { 
                console.log(markerPosition[j]); 
                var marker = new google.maps.Marker({
                    animation: google.maps.Animation.DROP,
                    position: new google.maps.LatLng(markerPosition[j][0], markerPosition[j][1]),
                    map: map
                });    
				markers.push(marker);
            }
			var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://cdn.rawgit.com/googlemaps/js-marker-clusterer/gh-pages/images/m'});
			
			
			}
		</script>
		<script src="https://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/data.json"></script>
<script src="https://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer.js"></script>
		<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
		<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxnsyYMvJxgZDT2Yx7l3HRy51nUS1VvUY&callback=myMap"></script>
		
		<br><br><br>
		
		
		
    </div>
	

	




	
  </div>
</div>



<!-- Contact Section -->



<!-- Footer Section -->

<footer><br/><br/><br/>
	<div class="container">
		<div class="row">
			
			<!-- New line -->
            <div class="clearfix col-md-12 col-sm-12">
                <hr>
            </div>
			
			<!-- Social networks links -->
		    <div class="col-md-12 col-sm-12">
                <ul class="social-icon">
                    <li><a href="#" class="fa fa-facebook" ></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                    <li><a href="#" class="fa fa-google-plus"></a></li>
                    <li><a href="#" class="fa fa-linkedin"></a></li>
                </ul>
            </div>
			   
			<!-- New line -->
			<div class="clearfix col-md-12 col-sm-12">
                <hr>
            </div>
			
			<!-- About Us -->
            <div class="col-md-5 col-md-offset-1 col-sm-6">
                <h3>About Us</h3>
                <p>This website was developed by Lama Ismail, Nadine Atoui and Nader Farhat.</p>
                <div class="footer-copyright">
                <p>Copyright &copy; 2017 FYP.</br> All rights reserved.</p>
                </div>
            </div>

			<!-- Contact us location/phoneNumber/mail -->
            <div class="col-md-4 col-md-offset-1 col-sm-6">
                <h3>Talk to us</h3>
                <p><i class="fa fa-globe"></i> Bliss Street, Beirut, Lebanon.</p>
                <p><i class="fa fa-phone"></i> +96171716081</p>
                <p><i class="fa fa-save"></i> nnf03@mail.aub.edu</p>
            </div>

			<!-- New line -->
            <div class="clearfix col-md-12 col-sm-12">
                <hr>
            </div>
			   
        </div>
    </div>
</footer>

<script src="js/jquery.js"></script>


</body>
</html>