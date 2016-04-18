<?php
  if(!isset($_SESSION)){
  session_start();
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Welcome</title>
  <script src="jquery-2.1.3.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  
  <style type="text/css">
 .main_body{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('imgs/im2.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100%;
    opacity: 0.2;
    filter:alpha(opacity=20);

  }
  .bg_header {
    background-color: #450915;
    background-image: url("imgs/bg-1.jpg");
    color: #ceb6b8;
  }
  .content_body {
    padding-top: 5%;
  }

  </style>

</head>
<body>
  <div class="main_body"></div>

<!-- NAVIGATION BAR BEGINS -->
<nav class="navbar navbar-inverse bg_header">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="#">npn Car Rental </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li style="background-color: white;" class="active"><a>Welcome Admin <span class="sr-only">(current)</span></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="#" >All Bookings</a></li>
        <li><a href="car-add.php">Add a new car</a></li>
        <li><a href="view-all-car.php">View all cars</a></li>
        <li><a href="logout.php">Logout</a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- NAVIGATION BAR ENDS -->

<div class="container">
  
  <div class="btn-group btn-group-justified" role="group" >
    <a href="admin-previous.php" role="button" class="btn btn-default btn-lg active">Previous Bookings</a>
    <a href="home2.php" role="button" class="btn btn-default btn-lg">Current Bookings</a>
    <a href="admin-future.php" role="button" class="btn btn-default btn-lg">Future Bookings</a>
  </div>


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

    $sql = "SELECT * FROM bookings ";
    $result=mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    ?>
    <br><br>
    <table class="table table-striped table-bordered">
      <thead>
      <tr>
        <th>Booking id</th>
        <th>Vehicle name</th>
        <th>Vehicle number</th>
        <th>Vehicle type</th>
        <th>Starting date and time</th>
        <th>Ending date and time</th>
        <th>Booking date and time</th>
        <th>Customer details</th>
        <th>Total Cost</th>
      </tr>
      </thead>
      <tbody>
    <?php
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
         if (function_exists('date_default_timezone_set'))
          {
              date_default_timezone_set('Asia/Kolkata');
          }
              $date_curr=date('Y-m-d');
              $time_curr=date('H:i:s');
              $flag=0;
              $flag2=0;
              if($date_curr==$row['date_end'])
              {
                $flag=1;
                if($time_curr>$row['time_end'])
                  $flag2=1;
                else
                  $flag2=0;
              }
              elseif($date_curr>$row['date_end'])
              {
                $flag=1;
                $flag2=1;
              }
              else
              {
                $flag=0;
                $flag2=0;
              }

              if($flag==1&&$flag2==1)
              {
                 $vid=$row['vehicle_id'];
                 echo '<tr>';
                echo '<td>'.$row['booking_id'].'</td>';
                

              $d1=$row['date_start'];
              $d2=$row['date_end'];
              $t1=$row['time_start'];
              $t2=$row['time_end'];
              $s1=strtotime($d1.' '.$t1);
              $s2=strtotime($d2.' '.$t2);
              $diff=$s2-$s1;
              $hours= ($diff/(60*60));

                $rental='';
                
                $sql2 = "SELECT * FROM vehicle where vehicle_id='{$vid}'";
                $result2=mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                  while($row2 = mysqli_fetch_assoc($result2)) {
                    echo '<td>'.$row2['vehicle_name'].'</td>';                      
                    echo '<td>'.$row2['vehicle_number'].'</td>';
                    echo '<td>'.$row2['vehicle_type'].'</td>';
                    $rental=$row2['vehicle_rentalcost'];
                  }
                }

                echo '<td>'.$row['date_start'].'<br>';
                echo $row['time_start'].'</td>';
                echo '<td>'.$row['date_end'].'<br>';
                echo $row['time_end'].'</td>';
                echo '<td>'.$row['date_curr'].'<br>';
                echo $row['time_curr'].'</td>';

                echo '<td>Cid : ';
                $cid=$row['cust_id'];
                echo $cid.'<br>';
                $sql2 = "SELECT * FROM customer where cid='{$cid}'";
                $result2=mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                  while($row2 = mysqli_fetch_assoc($result2)) {
                    echo $row2['cname'].'<br>';                      
                    echo $row2['caddress'].','.$row2['ccity'].','.$row2['cpincode'].','.'<br>';
                    echo $row2['ccontactno'].'<br>';
                  }
                }
                echo '</td>';
                echo '<td>'.$hours*$rental.'</td>';
                echo '</tr>';

            }

              }
        }
     
    else 
    {
        echo '<h3>No Booking !</h3>';
      exit;
    }

    mysqli_close($conn);
    



    ?>
</tbody>
</table>
</div>
</body>
</html>