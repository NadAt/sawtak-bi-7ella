<?php
extract($_POST);
if($_POST['act'] == 'add-com'):
	$name = htmlentities($name);
    $email = htmlentities($email);
    $comment = htmlentities($comment);
    // echo 'clicked';
   // $report_Id = htmlentities($reportId);

    // Connect to the database
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
    
	
	// Get gravatar Image 
	// https://fr.gravatar.com/site/implement/images/php/
	$default = "mm";
	$size = 35;
    $grav_url = "http://www.gravatar.com/avatar/" ."?d=" . $default . "&s=" . $size;

	if(strlen($name) <= '1'){ $name = 'Guest';}
    //insert the comment in the database
    $dateTime = date("Y-m-d H:i:s");
    
    $insert = $conn->query("INSERT INTO `comments`(`report_Id`, `comment`, `comment_date`, `name`, `email`) VALUES ('$reportId','$comment','$dateTime','$name','$email')");
   if($insert){
      // echo 'inserted';
   }
?>

    <div class="cmt-cnt">
    	<img src="<?php echo $grav_url; ?>" alt="" />
		<div class="thecom">
	        <h5><?php echo $name; ?></h5><span  class="com-dt"><?php echo date('d-m-Y H:i'); ?></span>
	        <br/>
	       	<p><?php echo $comment; ?></p>
	    </div>
	</div><!-- end "cmt-cnt" -->

	<?php  ?>
<?php endif; ?>