<?php
  if(!isset($_SESSION)){
  session_start();
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Welcome</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  
  <script src="jquery-2.1.3.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

  
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
        <li style="background-color: white;" class="active"><a>Welcome <?php echo $_SESSION['SUname'] ?> <span class="sr-only">(current)</span></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" >Home</a></li>
        <li><a href="book.php">Book A Car</a></li>
        <li class="active"><a href="allbookings.php">All Bookings</a></li>
        <li><a href="cancel.php">Cancel Booking</a></li>
        <li><a href="edit.php">Edit Info</a></li>
        <li><a href="logout.php">Logout</a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- NAVIGATION BAR ENDS -->

<div class="container">
  
  <div class="btn-group btn-group-justified" role="group" >
    <a role="button" class="btn btn-default btn-lg active">Future Bookings</a>
  </div>


<?php 
    $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') 

                    === FALSE ? 'http' : 'https';

    $host     = $_SERVER['HTTP_HOST'];
    $script   = $_SERVER['SCRIPT_NAME'];
    $currentUrl = $protocol . '://' . $host . $script;

    function checkDateP($date,$endDate)//curr date is greater than date_end
    {
      list($year,$month, $day) = split('[/.-]', $date);
      list($endYear,$endMonth, $endDay) = split('[/.-]', $endDate);
/*
      if($year<=$endYear){
        if ($month>=$endMonth){
          if ($day>$endDay){
            return 0;
          }
        }
      }
      
      */
      if($year<=$endYear){
        if ($year==$endYear&&$month<=$endMonth){
          if ($month==$endMonth&&$day<$endDay){
            return 0;
          }
          elseif ($month<$endMonth) {
            return 0;
          }
        }
        elseif ($year<$endYear) {
          return 0;
        }
      }
      
      return 1;
    }

    function checkTimeP($Utime,$endTime)
    {
      // Delimiters may be slash, dot, or hyphen
      $hr=0;
      $min=0;
      list($hr,$min) = split('[:]', $Utime);
      //echo "Month: $month; Day: $day; Year: $year<br />\n";
      list($endHr,$endMin, $endSec) = split('[:]', $endTime);

      if($hr<=$endHr){
        return 0;
      }
      return 1;
    }

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
        <tr>
<td>

      <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
      Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {

    $('#myModal').on('shown.bs.modal', function () {
      $('#myInput').focus();
    });
    });

    </script>

</td>
</tr>
</tbody>
</table>
</div>
</body>
</html>