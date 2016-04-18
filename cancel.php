<?php
  if(!isset($_SESSION)){
  session_start();
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Welcome</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  
  <script src="jquery-2.1.3.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

  
  <style type="text/css">
 .main_body{
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
      <a class="navbar-brand" href="#">Car-go Car Rental </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li style="background-color: white;" class="active"><a>Welcome <?php echo $_SESSION['SUname'] ?> <span class="sr-only">(current)</span></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" >Home</a></li>
        <li><a href="book.php">Book A Car</a></li>
        <li ><a href="allbookings.php">All Bookings</a></li>
        <li class="active"><a href="cancel.php">Cancel Booking</a></li>
        <li><a href="edit.php">Edit Info</a></li>
        <li><a href="logout.php">Logout</a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- NAVIGATION BAR ENDS -->

<div class="container">
  
  <div class="btn-group btn-group-justified" role="group" >
    <a role="button" class="btn btn-default btn-lg active">Cancel Bookings</a>
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

    $sql = "SELECT * FROM bookings where cust_id='{$_SESSION['SUid']}'";
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
        <th>Total Cost</th>
        <th>Cancel Booking</th>


      </tr>
      </thead>
      <tbody>
    <?php
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {

          $bid=$row['booking_id'];
         if (function_exists('date_default_timezone_set'))
          {
              date_default_timezone_set('Asia/Kolkata');
          }
              $date_curr=date('Y-m-d');
              $time_curr=date('H:i:s');
              $flag=1;
              $flag2=1;
              if($date_curr==$row['date_start'])
              {
                $flag=0;
                if($time_curr<$row['date_start'])
                  $flag2=0;
                else
                  $flag2=1;
              }
              elseif($date_curr>$row['date_start'])
              {
                $flag=1;
                $flag2=1;
              }
              else
              {
                $flag=0;
                $flag2=0;

              }
              if($flag==0&&$flag2==0)
              {
                 $id=$row['vehicle_id'];
                 ?>
                 <tr>
                <td><?php echo $row['booking_id'];?></td>
                
<?php
              $d1=$row['date_start'];
              $d2=$row['date_end'];
              $t1=$row['time_start'];
              $t2=$row['time_end'];
              $s1=strtotime($d1.' '.$t1);
              $s2=strtotime($d2.' '.$t2);
              $diff=$s2-$s1;
              $hours= ($diff/(60*60));

                $rental='';
                
                $sql2 = "SELECT * FROM vehicle where vehicle_id='{$id}'";
                $result2=mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                  while($row2 = mysqli_fetch_assoc($result2)) {
                    ?>
                    <td><?php echo $row2['vehicle_name']; ?></td>                      
                    <td><?php echo $row2['vehicle_number']; ?></td>
                    <td><?php echo $row2['vehicle_type']; ?></td>
                    <?php
                    $rental=$row2['vehicle_rentalcost'];
                  }
                }
?>
                <td><?php echo $row['date_start'].'<br>';
                echo $row['time_start']; ?></td>
                <td><?php echo $row['date_end'].'<br>';
                echo $row['time_end']; ?></td>
                <td><?php echo $row['date_curr'].'<br>';
                echo $row['time_curr']; ?></td>

                <td><?php echo $hours*$rental; ?></td>

<td>
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo $row['booking_id']?>">
      Cancel ?
    </button>

    <!-- Modal -->


    <script type="text/javascript">
    $(document).ready(function() {
    
    });
    </script>

    <div class="modal fade" id="myModal<?php echo $row['booking_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModal<?php echo $row['booking_id']?>Label" aria-hidden="true" style="color: black;">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this booking?<br><br>
            <button type="button" class="btn btn-primary " data-dismiss="modal">No</button>
            <a href="cancel-action.php?booking_id=<?php echo $bid;?>" role="button" type="button" class="btn btn-default">Yes</a>
         </div>

        </div>
      </div>
    </div>

</td>
</tr>
<?php

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