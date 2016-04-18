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
        <li class="active"><a href="#" >Home</a></li>
        <li><a href="book.php">Book A Car</a></li>
        <li><a href="allbookings.php">All Bookings</a></li>
        <li><a href="cancel.php">Cancel Booking</a></li>
        <li><a href="edit.php">Edit Info</a></li>
        <li><a href="logout.php">Logout</a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- NAVIGATION BAR ENDS -->
<div class="container">
  <div class="jumbotron">
  <p>
    Car-go Car Rental is one of the leading car rental services available in Delhi and NCR region.
  </p>
  <p>
    We offer vehicles ranging from SUVs, Sedans, MUVs, Luxury vehicles etc, all at affordable prices.
  </p>
  <p>
    We work to ensure that you enjoy your ride in our vehicles which are in excellent working condition. </p>
    <p>
      BON JOUR!
  </p>
  </div>
</div>
</body>
</html>