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
        <li><a href="home.php" >Home</a></li>
        <li><a href="book.php">Book A Car</a></li>
        <li><a href="allbookings.php">All Bookings</a></li>
        <li><a href="cancel.php">Cancel Booking</a></li>
        <li class="active"><a href="edit.php">Edit Info</a></li>
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
  if(isset($_POST['Cp'])||isset($_POST['Ca'])||isset($_POST['Cc'])||isset($_POST['Cpin'])||isset($_POST['Cno']) ) 
  {

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
    $sql="UPDATE `customer` SET `cpassword`='{$_POST['Cp']}' , `caddress`='{$_POST['Ca']}' , `ccity`='{$_POST['Cc']}' ,
    `cpincode`='{$_POST['Cpin']}' , `ccontactno`='{$_POST['Cno']}' where `cid`={$_SESSION['SUid']} ";
  //  echo $sql;

   if (mysqli_query($conn, $sql)) {
          echo "<h3>  Record updated successfully<br></h3>";
        //  echo $sql;
         // header("Location: http://localhost/car/home.php");
            
      } else {
          echo "Error editing record: " . mysqli_error($conn);
          echo "<a href='edit.php'>Back</a>";
      }

    mysqli_close($conn);   
  }

?>
