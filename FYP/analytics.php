<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">

	<title>FYP</title>

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.js">
	<link rel="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js">
	<link rel="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.js">
	<link rel="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js">
	<!-- Main css -->
	<link rel="stylesheet" href="css/main.css">

	
	

<script>

</script>
	
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
        <li ><a href="prepareMaps.php">PrepareMaps</a></li>
        <li class="active"><a href="analytics.php">Analytics/Statistics</a></li>
        <li><a href="profile.html">Profile</a></li>
      </ul><br>
    </div>
    <br>
	
	<?php
	$server = mysqli_connect("localhost", "root", "", "299v2");
	$result = mysqli_query($server, "Select report.category_id, category.category_name, category.Id, report.approved from report inner join category_id=Id where approved =1");
	
	
	
	?>
    
	<div class="col-sm-9">
		
		<br><br><br>
		
		<div class="row">
        <div class="col-sm-6">
          <div class="well">
            <h4>Last 7 days</h4>
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
			
          </div>
        </div>
        <div class="col-sm-6">
          <div class="well">
            <h4>Top categories</h4>
            
			
          </div>
        </div>
        
    </div>
		
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

<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script type="text/javascript" src="/path/to/fusioncharts.js"></script>
<script type="text/javascript" src="/path/to/fusioncharts.jqueryplugin.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</body>
</html>