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
      <a class="navbar-brand" href="#">Car-go Car Rental </a>
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

  if(isset($_SESSION['SUid'])) {

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

    $sql = "SELECT * FROM customer where cid='{$_SESSION['SUid']}' ";
    $result=mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
?>

<div class="center">    
<div class=" col-md-6 ">
      <div class="panel panel-default">
          <div class="panel-heading text-center">Edit Information</div>
      <div class="panel-body">

  <form action="edit-action.php" method="post">
      <div class="form-group">
        <label for="exampleInputName2">Password</label>
        <input type="password" class="form-control"  placeholder="<?php echo $row['cpassword']; ?>" value="<?php echo $row['cpassword']; ?>" name="Cp">
      </div>

       <div class="form-group">
        <label for="exampleInputName2">Address</label>
      <input type="text" class="form-control"  placeholder="<?php echo $row['caddress']; ?>" value="<?php echo $row['caddress']; ?>"   name="Ca">
      </div>


      <div class="form-group">
        <label for="exampleInputName2">City</label>
      <input type="text" class="form-control"  placeholder="<?php echo $row['ccity']; ?>" value="<?php echo $row['ccity']; ?>"   name="Cc">
      </div>


      <div class="form-group">
        <label for="exampleInputName2">Pincode</label>
      <input type="text" class="form-control"  placeholder="<?php echo $row['cpincode']; ?>" value="<?php echo $row['cpincode']; ?>"   name="Cpin">
      </div>

      <div class="form-group">
        <label for="exampleInputName2">Contact Number</label>
      <input type="text" class="form-control"  placeholder="<?php echo $row['ccontactno']; ?>" value="<?php echo $row['ccontactno']; ?>"  name="Cno">
      </div>

        <div class="text-center">
      <button type="submit" class="btn btn-success">Edit</button>
    </div>

  </form>
</div>

<?php
}
    } 
    else 
    {
        echo "Error!" ;
      exit;
    }

    mysqli_close($conn);
    
  }

?>

        </div>
      </div>
    </div>
  </div>

</div>
</body>
</html>