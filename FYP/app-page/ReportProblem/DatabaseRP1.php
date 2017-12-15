<?php
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300);

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

if (isset($_POST['submit'])) {
	
    $category = $_POST['category'];
    $lat = $_POST['latitude'];
    $long = $_POST['longitude'];
    $summary = $_POST['textbox'];
    $file = $_FILES['image']['tmp_name'];
    $catId = 0;
    $locId = 0;
    $imageId = 0;
    $repDate = date("Y-m-d");
    
	
	
   
       
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

       echo " cat id " . $catId . '</br>';
       echo "loc id " . $locId . '</br>';
       echo "im gid " . $imageId. '</br>';

    /////////////////////// Insert Report///////////////////////////////
    $insertReport = $conn->query("INSERT into report(report_text, category_id, image_id, report_status, location_id, report_date) VALUES('$summary', '$catId','$imageId','0','$locId','$repDate')");

    //////////////////////////////////////////////////////

    mysqli_close($conn);
        
}

?>  