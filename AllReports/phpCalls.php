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



$upVotes = $_POST['variable'];
$id = $_POST['id'];
//$update = $conn->query("UPDATE report SET upVotes = '$upVotes' WHERE report_Id = '$params'");

$update = "UPDATE report ". "SET upVotes = $upVotes ". 
"WHERE report_Id = $id" ;
mysql_select_db('299v1');
$retval = mysql_query( $update, $conn );

if(! $retval ) {
    die('Could not update data: ' . mysql_error());
 }
 echo "Updated data successfully\n";
 
 mysql_close($conn);

?>