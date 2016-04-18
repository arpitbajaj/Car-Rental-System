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


<?php 
    $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') 

                    === FALSE ? 'http' : 'https';

    $host     = $_SERVER['HTTP_HOST'];
    $script   = $_SERVER['SCRIPT_NAME'];
    $currentUrl = $protocol . '://' . $host . $script;


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

		date_default_timezone_set('UTC');
		$date_curr=date('Y-n-j');
		$time_curr=date('h:i:s');
		$sql = "INSERT INTO bookings(cust_id,vehicle_id,date_start,date_end,time_start,time_end,date_curr,time_curr) VALUES 
		( '{$_GET["cust-id"]}', '{$_GET["vehicle-id"]}', '{$_GET["date-start"]}', '{$_GET["date-end"]}', '{$_GET["time-start"]}', '{$_GET["time-end"]}','{$date_curr}','{$time_curr}' )";
		if (mysqli_query($conn, $sql)) {

		    echo '<div class="container panel panel-primary" style="width: 500px;">';
		    ?>
		    <div class="panel-heading">Bill</div>
  <div class="panel-body">
    
    <?php        
              $id=$_GET["vehicle-id"];
              $d1=$_GET["date-start"];
              $d2=$_GET["date-end"];
              $t1=$_GET["time-start"];
              $t2=$_GET["time-end"];
              
              $s1=strtotime($d1.' '.$t1);
              $s2=strtotime($d2.' '.$t2);
              $diff=$s2-$s1;
              $hours= ($diff/(60*60));

                $rental='';
                
                echo "Starting date and time : <strong>".$_GET["date-start"]." , ".$_GET["time-start"]." </strong><br>";
                echo "Ending date and time : <strong>".$_GET["date-end"]." , ".$_GET["time-end"]." </strong><br>";
                $sql2 = "SELECT * FROM vehicle where vehicle_id='{$id}'";
                $result2=mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                  while($row2 = mysqli_fetch_assoc($result2)) {
                    echo 'Vehicle name : <strong>'.$row2['vehicle_name'].'</strong><br>';                      
                    echo 'Vehicle number : <strong>'.$row2['vehicle_number'].'</strong><br>';
                    echo 'Vehicle type :<strong> '.$row2['vehicle_type'].'</strong><br>';
                    $rental=$row2['vehicle_rentalcost'];
                  }
                }



                echo 'Total cost : <strong>Rs '.$hours*$rental.'</strong><br>';
           
		} 
		else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);

	

?>
</div>
</div>
</body>
</html>