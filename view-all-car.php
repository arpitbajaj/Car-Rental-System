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
        <li><a href="home2.php" >All Bookings</a></li>
        <li><a href="car-add.php">Add a new car</a></li>
        <li class="active"><a href="view-all-car.php">View all cars</a></li>
        <li><a href="logout.php">Logout</a></li>

        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- NAVIGATION BAR ENDS -->

<br><br>
  <div class=" container row" >
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

        $sql = "SELECT * FROM vehicle  inner JOIN images_tbl  ON (vehicle.vehicle_number=images_tbl.vehicle_no) ";
        
        $result=mysqli_query($conn, $sql);
        
        $id="";
        $name="";
        
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $id=$row["vehicle_id"];
                 $name=$row["vehicle_name"];
                
        
                      echo '<div class="col-sm-6 col-md-4">';
                        echo '<div class="thumbnail" style="width: 350px; height:450px; " >';
                         echo '<img class="img-responsive" src="user_images/'.$row["name"].'."'.' alt="'.$row["vehicle_name"].'">';
                          //echo '<img src="'.$row["vehicle_name"].'.png"'.' alt="'.$row["vehicle_name"].'">';
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
                      
                            echo '</p>';
                          echo '</div>';
                        echo '</div>';
                      echo '</div>';    
             }   
           exit;
            
        } 
        else {
            echo "<h3>0 results</h3>";
        }

                    echo '</div>';
        mysqli_close($conn);
        
    

?>
</div>
</body>
</html>