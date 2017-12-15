<?php
$servername = "localhost";

$username = "root";

$password = "";

$dbname = "299V1";

// Create connection

$conn = mysqli_connect( "localhost", $username,$password,$dbname);





// Check connection

if ($conn->connect_error) {

die("Connection failed: " . $conn->connect_error);}




                if(isset($_POST['submit'])){
                        $category = $_POST['category'];
                        $lat = $_POST['latitude'];
                        $long = $_POST['longitude'];
                        $summary = $_POST['textbox'];

						// echo $summary.'</br>';

                                        

                                    //echo $category . '</br>';

                                    $sql = "SELECT Id from category WHERE category_name = '$category'";

                                    $sql1 = "INSERT INTO location(`latitude`, `longitude`) VALUES ('$lat','$long')";

                                    $sqlLocationId = "SELECT Id from location WHERE latitude = '$lat' AND longitude = '$long'"; 

                                    $sqlCheck ="SELECT latitude from location WHERE latitude = '$lat' AND longitude = '$long'"; 

                        

                                ///////////////// Execute select query///////////////

                                    $result = mysqli_query($conn,$sql);

								////////////////Execute Insert Query//////////////          
                                $checkLocation = mysqli_query($conn,$sqlCheck);
                                if($checkLocation->num_rows == 0){  
									mysqli_query($conn, $sql1);    
								}
                                /////////////////////////////////////////////////////

                                //////////////////Execute get Location Id query///////

                                    //  if( mysqli_query($conn, $sql1)  ){

                                            $locationResult = mysqli_query($conn,$sqlLocationId);

                                            if($locationResult ){
                                                while($row = mysqli_fetch_array($locationResult)){
												//echo "Location Id" .(int)$row[0];

                                                }

                                            }



                                    //  }



                                //////////////////////////////////////////////////////

                                        if($result ){
                                            while($row = mysqli_fetch_array($result)){
												// printf($row[0]);
												$catId = (int)$row[0];
											}
                                        }
                                            




                                                


                                        //  echo $row['Id'] . '<br />';

                                        //echo $row[0]['Id'];

                                

                                        

                                

                                ///}





                                



                                    mysqli_close($conn);}       

?>                              