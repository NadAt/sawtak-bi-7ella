
<?php
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300);

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

if (isset($_POST['submit'])) {
	
    $category = $_POST['category'];
    $lat = $_POST['latitude'];
    $long = $_POST['longitude'];
    $title = $_POST['titleTextbox'];
    $summary = $_POST['textbox'];
    $file = $_FILES['image']['tmp_name'];
    $catId = 0;
    $locId = 0;
    $imageId = 0;
    $repDate = date("Y-m-d");
    
	
// 	echo $summary . '</br>';
//    echo $lat . '</br>';
//     echo $long . '</br>';
// 	echo $category . '</br>';
//    echo $file . '</br>';//check if there's an image
    
	
	
	
   
       
    //echo $category . '</br>';
    
    $sql = "SELECT Id from category WHERE category_name = '$category'";
    $sql1 = "INSERT INTO location( `latitude`, `longitude`) VALUES ('$lat','$long')";
    $sqlLocationId = "SELECT Id from location WHERE latitude = '$lat' AND longitude = '$long'";
    $sqlCheck = "SELECT latitude from location WHERE latitude = '$lat' AND longitude = '$long'";
    

    ///////////////// Execute select query///////////////
    $result = mysqli_query($conn, $sql);
   
    
    ////////////////Execute Insert Query//////////////          
    $checkLocation = mysqli_query($conn, $sqlCheck);
    
    if ($checkLocation->num_rows == 0) { 
        mysqli_query($conn, $sql1);
    }    
    /////////////////////////////////////////////////////
    
    //////////////////Execute get Location Id query///////
    $locationResult = mysqli_query($conn, $sqlLocationId);
    if ($locationResult) {
        while ($row = mysqli_fetch_array($locationResult)) {
            $locId = (int) $row[0];
            //echo $locId .'</br>';
        }
    }
    //////////////////////// category id //////////////////////////////
        $re = Array();
         while ($row = $result->fetch_assoc()) {
            $re = explode(",", $row["Id"]);
           // echo $re[0];
           $catId =(int) $re[0];
        }

    //    echo " cat id " . $catId . '</br>';
    //    echo "loc id " . $locId . '</br>';
    //    echo "im gid " . $imageId. '</br>';

    /////////////////////// Insert Report///////////////////////////////
    $insertReport = $conn->query("INSERT INTO report( report_text,report_title, category_id, location_id, report_date) VALUES('$summary','$title', '$catId','$locId','$repDate')");
        
    //////////////////////////////////////////////////////

    ////////////////////////////////// Get Report Id/////////////////////////////////////

       $report_Id = 0;
       $getReportId = $conn->query("SELECT report_Id FROM report WHERE report_text = '$summary' AND category_id = '$catId' AND location_id = '$locId' "); 

       $reportIds = Array();
       while ($row = $getReportId->fetch_assoc()) {
          $reportIds = explode(",", $row["report_Id"]);
           
         // echo $re[0];
         $report_Id = (int) $reportIds[0];
         echo $report_Id;
      }
    ////////////////////////////////////////////////////////////////////////////////////

    ////////////////// Insert Image Data to DB /////////////////////
	$check = getimagesize($_FILES['image']['tmp_name']);
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
		
		//echo "an image was inserted" . '</br>';
		
		$dataTime = date("Y-m-d H:i:s");
        
        //Insert image content into database
        $insert = $conn->query("INSERT into images (image, created,report_Id) VALUES ('$imgContent', '$dataTime','$report_Id')");

        /************* Get Image Id ****************/
        $getImageId = $conn->query("SELECT id from images WHERE image = '$imgContent'");
        while ($row = mysqli_fetch_array($getImageId)) {
            $imageId = (int) $row[0];
            //echo "--> " . $imageId . " <-- </br>";
        } 
        
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
	
	

    mysqli_close($conn);
        
}

?>  


