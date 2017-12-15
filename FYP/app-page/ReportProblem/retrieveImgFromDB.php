<?php
if(!empty($_GET['id'])){
    //DB details
    $servername = "localhost";
	$username   = "root";
	$password   = "";
	$dbname     = "299V1";
    
    //Create connection and select DB
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    //Check connection
    if($conn->connect_error){
       die("Connection failed: " . $conn->connect_error);
    }
    
    //Get image data from database
    $result = $conn->query("SELECT image FROM images WHERE id = {$_GET['id']}");
    
    if($result->num_rows > 0){
        $imgData = $result->fetch_assoc();
        
        //Render image
        header("Content-type: image/jpg"); 
        echo $imgData['image']; 
    }else{
        echo 'Image not found...';
    }
}
?>