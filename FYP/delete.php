<?php
$server = mysqli_connect("localhost", "root", "", "299v2");

$id =$_REQUEST['Id'];
	
	
	// sending query
	mysqli_query($server, "DELETE FROM report WHERE report_Id = '$id'")
	or die(mysqli_error($server));  	
	
	header("Location: prepareMaps.php");
?>