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
        <li style="background-color: white;" class="active"><a>Welcome Admin <span class="sr-only">(current)</span></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">

        <li><a href="home2.php" >All Bookings</a></li>
        <li class="active"><a href="car-add.php">Add a new car</a></li>
        <li><a href="view-all-car.php">View all cars</a></li>
        <li><a href="logout.php">Logout</a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- NAVIGATION BAR ENDS -->




<div class="center">   
<?php if (isset($error)) {?>
    <p>
      <?php echo $error;?>
    </p>
    <?php }?> 
<div class=" col-md-6 ">
      <div class="panel panel-default">
          <div class="panel-heading text-center">ADD A CAR</div>
      <div class="panel-body">

  <form action="car-add-action.php" enctype="multipart/form-data" method="post" class="form">
      <div class="form-group">
        <label for="exampleInputName2">Vehicle Name</label>
        <input type="text" class="form-control"  placeholder="vehicle name" name="Vname">
      </div>

       <div class="form-group">
        <label for="exampleInputName2">Vehicle Number</label>
      <input type="text" class="form-control"  placeholder="vehicle number"   name="Vnumber">
      </div>


      <div class="form-group">
        <label for="exampleInputName2">Vehicle Type</label>
      <input type="text" class="form-control"  placeholder="vehicle type"   name="Vtype">
      </div>


      <div class="form-group">
        <label for="exampleInputName2">Vehicle Cost Per Km</label>
      <input type="text" class="form-control"  placeholder="vehicle cost per km"   name="Vcostperkm">
      </div>

      <div class="form-group">
        <label for="exampleInputName2">Vehicle Meter Reading</label>
      <input type="text" class="form-control"  placeholder="vehicle meter reading"  name="Vmeterreading">
      </div>

      <div class="form-group">
        <label for="exampleInputName2">Vehicle Rental Cost</label>
      <input type="text" class="form-control"  placeholder="vehicle rental cost"  name="Vrentalcost">
      </div>
      
   


            

        <div class="text-center">
      <input type="submit" value="SUBMIT" name="submit" class="btn btn-info"></button>
    </div>
  </form>        
</div>


        </div>
      </div>
    </div>
  </div>

</div>
</body>
</html>


    </body>
</html>