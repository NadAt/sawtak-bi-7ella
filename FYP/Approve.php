<?php
$server = mysqli_connect("localhost", "root", "", "299v2");

$id =$_REQUEST['Id'];
	
	
	// sending query
	mysqli_query($server, "UPDATE report set approved=1 WHERE report_Id = '$id'")
	or die(mysqli_error($server));  	
	
	header("Location: prepareMaps.php");
?>