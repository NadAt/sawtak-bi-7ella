<?php

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "299V2";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function setImages(){
    ////////////////// Insert Image Data to DB /////////////////////
	$check = getimagesize($_FILES['image']['tmp_name']);
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
		
		//echo "an image was inserted" . '</br>';
		
		$dataTime = date("Y-m-d H:i:s");
        
        //Insert image content into database
        $insert = $conn->query("INSERT into images (image, created,report_Id) VALUES ('$imgContent', '$dataTime','$report_Id')");

        
        if($insert){
           // echo "File uploaded successfully.". '</br>';
        }else{
            echo "File upload failed, please try again.". '</br>';
        } 
	}	
	else{
        echo "Please select an image file to upload.";
    }
    
	///////////////////////////////////////////////////////////////
	
	

}



?>