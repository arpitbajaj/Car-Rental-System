<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rent A Car</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<!-- NAVIGATION BAR BEGINS -->
<nav class="navbar navbar-inverse bg_header">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Car-go Car Rental </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li style="background-color: white;" class="active"><a>Welcome <?php echo $_SESSION['SUname'] ?> <span class="sr-only">(current)</span></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="home.php" >Home</a></li>
        <li class="active"><a href="book.php">Book A Car</a></li>
        <li><a href="allbookings.php">All Bookings</a></li>
        <li><a href="cancel.php">Cancel Booking</a></li>
        <li><a href="edit.php">Edit Info</a></li>
        <li><a href="logout.php">Logout</a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- NAVIGATION BAR Ends -->
<br><br>
<?php 
    $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') 

                    === FALSE ? 'http' : 'https';

    $host     = $_SERVER['HTTP_HOST'];
    $script   = $_SERVER['SCRIPT_NAME'];
    $currentUrl = $protocol . '://' . $host . $script;

    function checkDateBetween($date,$startDate,$endDate){
    	// Delimiters may be slash, dot, or hyphen
    /*	echo "<br>";
    	echo $date.$startDate.$endDate;
    	echo "<br>";
	*/	
		
		list($year,$month, $day) = split('[/.-]', $date);
		//echo "Month: $month; Day: $day; Year: $year<br />\n";
		list($startYear,$startMonth, $startDay) = split('[/.-]', $startDate);
		list($endYear,$endMonth, $endDay) = split('[/.-]', $endDate);

		if($year<=$startYear){
			if($year<$startYear){
				return 0;
			}
			elseif ($month<=$startMonth){
				if($month<$startMonth){
					return 0;
				}
				elseif ($day<$startDay){
					return 0;
				}
			}
		}
		if($year>=$endYear){
			if($year>$endYear){
				return 0;
			}
			elseif ($month>=$endMonth){
				if($month>$endMonth){
					return 0;
				}
				elseif ($day>$endDay){
					return 0;
				}
			}
		}
		if($endyear<=$startYear){
			if($endyear<$startYear){
				return 0;
			}
			elseif ($endmonth<=$startMonth){
				if($endmonth<$startMonth){
					return 0;
				}
				elseif ($endday<$startDay){
					return 0;
				}
			}
		}
		return 1;
		
    }
    function checkTime($Utime,$startTime,$endTime){

    	/*echo "<br>";
    	echo $Utime.$startTime.$endTime;
    	echo "<br>";
		*/
		// Delimiters may be slash, dot, or hyphen
		$hr=0;
		$min=0;
		list($hr,$min) = split('[:]', $Utime);
		//echo "Month: $month; Day: $day; Year: $year<br />\n";
		list($startHr,$startMin, $startSec) = split('[:]', $startTime);
		list($endHr,$endMin, $endSec) = split('[:]', $endTime);

		//echo $hr.":".$min."-".$startHr.":".$startMin.":". $startSec."-".$endHr.":".$endMin.":".$endSec;
		if($hr<=$startHr){
			if($hr==$startHr&&$min<$startMin){
				return 0;
			}
			elseif($hr<$startHr){
				return 0;
			}
		}
		if ($hr>=$endHr&&$min>$endMin) {
			if($hr==$endHr&&$min>$endMin){
				return 0;
			}
			elseif($hr>$endHr){
				return 0;
			}
		}
		return 1;
    }

	if(isset($_POST['Cstime'])&&isset($_POST['Cetime'])&&isset($_POST['Ctype'])&&isset($_REQUEST["date1"])&&isset($_REQUEST["date2"])) {
?>
		<p class="text-center"><?php echo "Cars available of ".$_POST['Ctype']." type from ".$_REQUEST["date1"]." ".$_POST['Cstime']." to ".$_REQUEST["date2"]." ".$_POST['Cetime']." are as follows :<br>" ?></p>
				<div class="contaier">
	<?php
		echo '<div class="container row">';
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "car";

		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		// Check connection
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}

//		$sql = "SELECT * FROM vehicle where vehicle_type='{$_POST['Ctype']}'";

        $sql = "SELECT * FROM vehicle  inner JOIN images_tbl  ON (vehicle_type='{$_POST['Ctype']}' and vehicle.vehicle_number=images_tbl.vehicle_no) ";
//		cust_name='{$_POST['Cname']}' and cust_phone='{$_POST['Cphone']}' and password= '{$_POST['Cpass']}'";

		        //echo "id: " . $row["name"]. " - Name: " . $row["phone"]. " " . $row["password"]. "<br>";
		$result=mysqli_query($conn, $sql);

		$id="";
		
		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
		    	$id=$row["vehicle_id"];
		    	$imgname=$row["name"];
		    	$sql2 = "SELECT * FROM bookings where vehicle_id=$id";
		    	$result2=mysqli_query($conn, $sql2);
		    	$showResult=1;
		    	//$breakLoop=0;
		    	//$dontPrint=1;
				$flag=0;
				if (mysqli_num_rows($result2) > 0) {
				    // output data of each row
				    while($row2 = mysqli_fetch_assoc($result2)) {

				    	$toPrint1=1;
		    			$toPrint2=1;
		    	

				//    	if($_POST['Cstime']>$row2[""] )
					  	$flag1=checkDateBetween( $_REQUEST["date1"],$row2["date_start"],$row2["date_end"]);
					  	$flag2=checkDateBetween( $_REQUEST["date2"],$row2["date_start"],$row2["date_end"],);
			    		
			    	  	if($flag1==0){//doesnt exist=>print details
			    	  		//$dontPrint=0;
			    	  		$toPrint1=1;
			    	  	//	$breakLoop=1;
			    		}
			    		else{

			    			//echo "by user : ".$_POST['Cstime']." to ".$_POST['Cetime']."<br>";
			    			//echo "date1 : ".$row2["time_start"]."to".$row2["time_end"];
			    			//check time
			    			$flag3=checkTime($_POST['Cstime'],$row2["time_start"],$row2["time_end"]);
			    			$flag4=checkTime($_POST['Cetime'],$row2["time_start"],$row2["time_end"]);
	    			//echo "<br> date1 :: flag3 : ".$flag3." flag4 : ".$flag4."<br>";
		
			    			if($flag3==0&&$flag4==0){		
			    				$toPrint1=1;
			    	  			//$breakLoop=1;
			    			}
			    			else{
			    				$toPrint1=0;
			    			}
			    		}

			    		if($flag2==0){//doesnt exist=>print details
			    			$toPrint2=1;
			    	  		//$breakLoop=1;
			    		}
			    		else{
			    			//echo "by user : ".$_POST['Cstime']." to ".$_POST['Cetime']."<br>";
			    			//echo "date2 : ".$row2["time_start"]."to".$row2["time_end"];
			    			//check time
			    			$flag3=checkTime($_POST['Cstime'],$row2["time_start"],$row2["time_end"]);
			    			$flag4=checkTime($_POST['Cetime'],$row2["time_start"],$row2["time_end"]);
			    		//	echo "<br> date2 :: flag3 : ".$flag3." flag4 : ".$flag4."<br>";
			    			
			    			if($flag3==0&&$flag4==0){		
			    				$toPrint2=1;
			    	  		//	$breakLoop=1;
			    			}
			    			else{
			    				$toPrint2=0;
			    			}
			    		}

						if($toPrint1==1&&$toPrint2==1)
						{
							$showResult=1;	
						}
						else
						{
							$showResult=0;
						}

			    	//	echo "<br>flag1 : ".$toPrint1." flag2 : ".$toPrint2."<br>";

				    }
				} if($showResult==1){
					  echo '<div class="col-sm-6 col-md-4">';
                        echo '<div class="thumbnail" style="width: 350px; height:450px; " >';
					      	
                         echo '<img src="user_images/'.$imgname.'."'.' alt="'.$row["vehicle_name"].'">';
					      	echo '<div class="caption">';
					        	echo '<h3>'.$row["vehicle_name"].'</h3>';
					        echo '<p>';								        	
								echo "vehicle number : ".$row["vehicle_number"]."<br>";
								echo "vehicle type : ".$row["vehicle_type"]."<br>";
								echo "cost per km : ".$row["vehicle_costperkm"]."<br>";
								echo "meter reading : ".$row["vehicle_meter_reading"]." km<br>";
								echo "rentalcost : ".$row["vehicle_rentalcost"]." Rs/hr<br>";
							
					        echo '</p>';
					        echo '<p>';
								echo "<a href='booking.php?cust-id=".$_SESSION['SUid']."&vehicle-id=".$id."&date-start=".$_REQUEST["date1"]."&date-end=".$_REQUEST["date2"]."&
								time-start=".$_POST['Cstime']."&time-end=".$_POST['Cetime']." '>Book</a>";
							echo '</p>';
					      echo '</div>';
					    echo '</div>';
					echo '</div>';
				}
				
		    }?>
			</div>
			<?php
		    exit;
		} 
		else {
		    echo "0 results";
		}
		mysqli_close($conn);
		
	}					  
	echo '</div>';
?>
</body>
</html>