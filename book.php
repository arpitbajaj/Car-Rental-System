<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>NPN CAR RENTAL SITE</title>
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
<div class="container">
	<form action="book-action.php" method="post">

		  <div class="form-group">
		    <label for="exampleInputName2">Enter starting date</label>
		   </div>
<?php
require_once('C:\xampp\htdocs\car\calendar\tc_calendar.php');
	  $myCalendar = new tc_calendar("date1", true, false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(1945, 2020);
	  $myCalendar->dateAllow("2008-05-13","2020-01-01");
	  $myCalendar->setAlignment("left", "bottom");
	  $myCalendar->writeScript();
?>
		<br><br>
	
		<div class="form-group">
		    <label for="exampleInputName2">Enter starting time (24 hour format)</label>
			<input type="text" class="form-control"  placeholder="hr:min"  name="Cstime" style="width: 20%;">
		  </div>
		  
<div class="form-group">
		    <label for="exampleInputName2">Enter ending date</label>
		   </div>
<?php
require_once('C:\xampp\htdocs\car\calendar\tc_calendar.php');
	  $myCalendar = new tc_calendar("date2", true, false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(1945, 2020);
	  $myCalendar->dateAllow("2008-05-13","2020-01-01");
	  $myCalendar->setAlignment("left", "bottom");
	  $myCalendar->writeScript();
?>
		<br><br>
	
		<div class="form-group">
		    <label for="exampleInputName2">Enter ending time (24 hour format)</label>
			<input type="text" class="form-control"  placeholder="hr:min"  name="Cetime" style="width: 20%;">
		  </div>
		  

		<div class="form-group">
		    <label for="exampleInputName2">Enter car type</label>
			<input type="text" class="form-control"  placeholder="SUV/Sedan/Luxury/MUV/Mini"  name="Ctype" style="width: 20%;">
		  </div
		  <br>
		  <button type="submit" class="btn btn-success">Submit</button>
		  <br><br>
	</form>
</div>


</body>
</html>


