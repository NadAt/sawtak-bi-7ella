<!DOCTYPE html>
<html  class="js flex mobile" lang="en">
   <head>
   
   <!-- Navigation Bar -->
	<!-- <!?php include('../NavigationBar/navigationBar.php'); ?> -->
	<!-- / Navigation Bar -->

      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Bootstrap Login Form Template</title>
	  
      <!-- CSS -->
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3mobile.css">
      <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
      <link rel="stylesheet" href="../assets/bootstrap/css/bootstrapRP.min.css">
      <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" href="../assets/css/form-elements.css">
      <link rel="stylesheet" href="../assets/css/styleReportProblem.css">
	  
      <!-- Favicon and touch icons -->
      <link rel="shortcut icon" href="../assets/ico/favicon.png">
      <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300' rel='stylesheet' type='text/css'>
	  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	  <!-- use the same array from php to get specific data -->
	  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	  <!-- Javascript -->
	  <script src="../assets/js/jquery-1.11.1.min.js"></script>
      <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
      <script src="../assets/js/jquery.backstretch.min.js"></script>
      <script src="../assets/js/scripts.js"></script>
	 
	  <!-- css for comments section -->
	  <link rel="stylesheet" href="../assets/css/example.css">
      <link rel="stylesheet" href="../assets/css/styleC.css">
	 
    
   </head>
   
		<!-- ---------------------------- database --------------------------------- -->
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
		
		// deocde the param passed in url 
		$params = json_decode($_GET['report']);
		//print_r($params);
		
		
                    
            //!!!!!!!!!!!!!!!!!!!!!!!!!!!! must add citizen id later on !!!!!!!!!!!!!!!!!!!!!!!!!!!!
            $testRetrieveDescription = $conn->query("SELECT * 
													FROM location l , report r, category c, images i
													WHERE l.Id = r.location_Id
													And c.Id = r.category_id
													And i.report_Id = r.report_Id
													And r.report_Id = '$params'");
            
            

            
            /* store values of report fields in a different array each*/
            while ($row = $testRetrieveDescription->fetch_assoc()) {
                $reportIdArray = $row['report_Id']; 
                $latArray = $row['latitude'];
                $longArray = $row['longitude'];
                $reportSummary = $row['report_text'];
                $catArray = $row['category_name'];
				$imgArray = $row['image'];
				$reportDate= $row['report_date'];
				$reportDate= date("M jS, Y", strtotime($row['report_date']));
                $userIdArray = $row['user_id'];
                $title = $row['report_title'];
				$reportUpVote = $row['upVotes'];
				$reportDownVote = $row['downVotes'];
			}

        
        ?>
		 
        <!-- --------------------------------------------------------------------- -->
   
   <body>
		<div class="wrapper">
		 <!-- map -->
         <div class="right" id="mapPos">
            <div id="map"></div>
         </div>
		 
         <!-- Top content -->
         <div class="left" id="reportPos" >
            <div class="top-content">
               <div class="inner-bg">
                  <div class="container">
				  
                     <!-- <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text reportText" id="reporttext">
                        </div>
                     </div> -->
					 
                     <div class="row">
						
                            <!-- ----------Report Table ------------ -->
                            <div class="col-sm-8 col-sm-offset-3 form-box reportTable" id="reporttable">
						
                            <div class="form-top">
                                <div class="form-top-left ">
										<!-- <b><h3> Include your updates! </h3></b>  -->
										<div class="reportInfo">
											<h1><p id = "title"></p> </h1>
												<p id="info"></p>
										</div> 
                                </div>
                            </div>
						   
							<div class="form-bottom">
                            <!-- <form role="form" action="" method="post" class="login-form" enctype="multipart/form-data"> -->
                            <!-- --------------------------------------------------------------------------- -->
                            									 
                            <!-- -------------------------------- Adding Photos -------------------------------- --> 
                            <table class="table table-bordered">  
                   				<h3> Images </h3>
								<?php
									if (mysqli_connect_errno()){
										echo "Failed to connect to MySQL: " . mysqli_connect_error();
									}
									if(isset($_POST["insert"])){  

										if(isset($_FILES['image'])){
											
											$dataTime = date("Y-m-d H:i:s");
											foreach($_FILES['image']['tmp_name'] as $key => $tmp_name ){
												
												$image =$_FILES['image']['tmp_name'][$key];
												$imgContent= addslashes(file_get_contents($image));
												//Insert image content into database
												$insert = $conn->query("INSERT into images (image, created,report_Id) VALUES ('$imgContent', '$dataTime','$params')");
											}
										}
									}  
				
									$result = $conn->query("SELECT * FROM images WHERE report_Id = '$params' ORDER BY created DESC");
									$i = 0;

									$ImagesArray = array();
									$j=0;
									while($row = $result->fetch_assoc()){  
										if($i % 3 == 0 ){
											echo '<tr>';
										}

										$ImagesArray[$j] ='<img id = "imgs'.$j.'" src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" height="200" width="200" class="img-thumnail" />';
										
										// echo $ImagesArray[$i];
							
									echo '
										<td> 
										'.$ImagesArray[$j].'
										<!-- The Modal -->
										<div id="myModal" class="modal">
										<span class="close">&times;</span>
										<img class="modal-content" id="img01">
										<div id="caption"></div>
										</div>

										</td>
										

										
										'; 
										?>
										<script>
										
										var modal = document.getElementById("myModal");
										var img[] = document.getElementById("imgs"+<?php echo $j; ?>);
										var modalImg = document.getElementById("img01");
										var captionText = document.getElementById("caption");

										img[].onclick = function(){
											modal.style.display = "block";
											modalImg.src = "";
											captionText.innerHTML = this.alt;
											console.log("<?php echo $j; ?>");
										}
										
										var span = document.getElementsByClassName("close")[0];
										
										span.onclick = function() { 
											modal.style.display = "none";
										}
										</script>

										<?php
										$j++;
										// echo $j;
										if($i % 3 == 2){
											echo '</tr>';
										}
										$i++;
									}  
								?>  

                			</table>  

							<form method="post" enctype="multipart/form-data">  
								<input type="file" name="image[]" id="image" multiple="" />  
								<br />  
								<input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" /> 
								<!-- The Modal -->
								<div id="myModal" class="modal">

								<!-- The Close Button -->
								<span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>

								<!-- Modal Content (The Image) -->
								<img class="modal-content" id="img01">
								</div> 
							</form>  
            
							<script> 
								$(document).ready(function() {
									$('#insert').click(function() {
										var image_name = $('#image').val();
										if (image_name == '') {
											alert("Please Select Image");
											return false;
										} else {
											var extension = $('#image').val().split('.').pop().toLowerCase();
											if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
												alert('Invalid Image File');
												$('#image').val('');
												return false;
											}
										}
									});
								});
								
							</script>      
                            <!-- --------------------------------------------------------------------------- -->
                            
							<!-- --------------------------- comments -------------------------------------- -->
							<h3> Comments </h3>             

                                    

                                <div class="cmt-container" >

                                    <?php 
                                        $reportId = $params;

                                        $sql = $conn->query("SELECT * FROM comments WHERE report_Id = '$reportId'") or die(mysql_error());;

                                        while($affcom = $sql->fetch_assoc()){ 
                                        $name = $affcom['name'];
                                        $email = $affcom['email'];
                                        $comment = $affcom['comment'];
                                        $date = $affcom['comment_date'];

                                        $default = "mm";
                                        $size = 35;

                                        $grav_url = "http://www.gravatar.com/avatar/".md5(strtolower(trim($email)))."?d=".$default."&s=".$size;
                                   ?>

                                    <div class="cmt-cnt" id = "comment">
                                        <img src="<?php echo $grav_url; ?>" />
                                        <div class="thecom">

                                            <h5><?php echo $name; ?></h5><span data-utime="1371248446" class="com-dt"><?php echo $date; ?></span>
                                            <br/>
                                            <p> <?php echo $comment; ?> </p>

                                        </div>
                                    </div><!-- end "cmt-cnt" -->

                                    <?php } ?>

                                    <div class="new-com-bt">
                                    <span>Write a comment ...</span>
                                    </div>

                                    <div class="new-com-cnt">
                                        <input type="text" id="name-com" name="name-com" value="" placeholder="Your name" />
                                        <input type="text" id="mail-com" name="mail-com" value="" placeholder="Your e-mail adress" />
                                        <textarea class="the-new-com"></textarea>
                                        <div class="bt-add-com">Post comment</div>
                                        <div class="bt-cancel-com">Cancel</div>
                                    </div>    

                                    <div class="clear"></div>

                                    </div><!-- end of comments container "cmt-container" -->

                                        <script type="text/javascript">

                                         $(function(){ 
                                                //alert(event.timeStamp);
                                                $('.new-com-bt').click(function(event){ 
                                                    $(this).hide();
                                                    $('.new-com-cnt').show();
                                                    $('#name-com').focus();
                                                });

                                                /* when start writing the comment activate the "add" button */
                                                $('.the-new-com').bind('input propertychange', function() {
                                                    $(".bt-add-com").css({opacity:0.6});
                                                    var checklength = $(this).val().length;
                                                    if(checklength){ 
                                                        $(".bt-add-com").css({opacity:1}); 
                                                    }
                                                });

                                                /* on click on the cancel button */
                                                $('.bt-cancel-com').click(function(){
                                                    $('.the-new-com').val('');
                                                    $('.new-com-cnt').fadeOut('fast', function(){
                                                        $('.new-com-bt').fadeIn('fast');
                                                    });
                                                });

                                                // on post comment click 
                                                $('.bt-add-com').click(function(){

                                                    var theCom = $('.the-new-com');
                                                    var theName = $('#name-com');
                                                    var theMail = $('#mail-com');

                                                    if( !theCom.val()){ 
                                                        alert('You need to write a comment!'); 
													}
													
													else{ 
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "../../ajax/add-comment.php",
                                                            data: 'act=add-com&reportId='+<?php echo $reportId; ?>+'&name='+theName.val()+'&email='+theMail.val()+'&comment='+theCom.val(),
                                                            success: function(html){
                                                                theCom.val('');
                                                                theMail.val('');
                                                                theName.val('');
                                                                $('.new-com-cnt').hide('fast', function(){
                                                                    $('.new-com-bt').show('fast');
                                                                    $('.new-com-bt').before(html); 
                                                                })
                                                            } 
                                                        });
                                                    }
                                                });
                                            });

                                        </script>
										<!-- --------------------------------------------------------------------------- -->
										<!-- --------------------------------------------------------------------------- -->
									 
								  <!-- </form> -->
                              <!-- </form> -->
							  </div> 
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
	  </div> 

			
    

	  <script type="text/javascript">

	  		///////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////

			//retreive the lat, long, cat, img array from php and storing them in new array in js
			var reportIdArray =  "<?php echo $reportIdArray; ?>";
			var catArray = "<?php echo $catArray; ?>";
			var reportSummary = "<?php echo $reportSummary; ?>";
			var userIdArray = "<?php echo $userIdArray; ?>";
			var reportUpVote = "<?php echo $reportUpVote; ?>";
			var reportDownVote ="<?php echo $reportDownVote; ?>"; 
			var reportTitle = "<?php echo $title; ?>"; 
			var reportDate = "<?php echo $reportDate; ?>"; 
			
			//retrieved report information
			document.getElementById('title').innerHTML = "<strong>" + reportTitle + "</strong>";
			document.getElementById('info').innerHTML = "<h3>Reported in the "+catArray+" category on "+ reportDate+" <br><br>" + reportSummary + "</h3>" ;
	
		

			///////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////
			
		 </script>
	  
	<script type="text/javascript">
	
			///////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////
			//////////////////////// Initmap function /////////////////////////////
			///////////////////////////////////////////////////////////////////////
	  
        var map;
        function initMap() {

			var latArray = "<?php echo $latArray; ?>";
			var longArray = "<?php echo $longArray; ?>";
			console.log(latArray);
			console.log(longArray);
			
			var myLatLng = {lat: latArray, lng: longArray};
         
			map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: -33.8688, lng: 151.2195},
				zoom: 13,
				mapTypeId: 'roadmap'
			});
					 

			
			var marker = new google.maps.Marker({
                    animation: google.maps.Animation.DROP,
                    position: new google.maps.LatLng(latArray, longArray),
                    map: map
			}); 
			map.setCenter(new google.maps.LatLng(latArray, longArray));
			        
			 	 
		}
		
		
		///////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////
		/////////////////// change css according to screen size ///////////////
		$(window).on('resize', function() {
		  var win = $(this);
		  var w;
		  if (win.width() < 800)  {

			
			$('#mapPos').addClass('top');
			$('#mapPos').removeClass('right');
			$('#reportPos').addClass('bottom');
			$('#reportPos').removeClass('left');
			$('#reporttable').addClass('reportTable');
			$('#reporttext').addClass('reportText');
			
			//set width of reportTable and reportText to window's width
			w = $(window).width();
			$('.reportTable').css('width', w);
			$('.reportText').css('width', w);
			

			
		  } else {
			$('#mapPos').addClass('right');
			$('#mapPos').removeClass('top');
			$('#reportPos').addClass('left');
			$('#reportPos').removeClass('bottom');
			
			//set width of reportTable and reportText to 0.3* window's width
			w = $(window).width();
			$('.reportTable').css('width', (0.3*w));
			$('.reportText').css('width', (0.3*w));			
		  }
		}).resize(); // Invoke the resize event immediately onload
	
	 		///////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////////////			
    </script>
    <!-- google maps API:  AIzaSyCB9kcH0PdYyVeYW-Ic3j7O8IbrGvHe5Jk   -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCB9kcH0PdYyVeYW-Ic3j7O8IbrGvHe5Jk&libraries=places&callback=initMap" async defer></script>
	


</html>