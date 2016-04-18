<?php
if(isset($_SESSION)){
      header("Location: http://localhost/menagere/home.php");
      exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Welcome</title>
 <!--
  <script src="jquery-2.1.3.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
-->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">

  <style type="text/css">

 .main_body{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('imgs/back.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100%;
    opacity: 0.3;
    filter:alpha(opacity=20);
  }
  .bg_header {
    background-color: #450915;
    background-image: url("imgs/bg.jpg");
    color: #ceb6b8;
  }
  .content_body {
    padding-top: 5%;
  }

  </style>
</head>
<body>
  <div class="main_body"></div>
 <nav   class="navbar navbar-inverse bg_header">
  <div class="container-fluid">
    <div class="navbar-header" style="padding-left:8%;">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Car-go Car Rental</a>
    </div>

    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <!--<li><a href="#about">About Us</a></li>
      -->
      </ul>
      <form class="navbar-form navbar-right" style="padding-right:8%;" action="signin-action.php" method="post">
  <div class="form-group">
    <input type="email" class="form-control" placeholder="Email Address" name="Cemail">
    <input type="password" class="form-control" placeholder="Password" name="Cpass">
  </div>
  <button type="submit" class="btn btn-danger">LOGIN</button>
</form>
    </div>
  </div>
</nav>
<div class="container">
  <div class="row">
    <div class="col-md-9 content_body">

<div class="text-center">
      <H2><strong> FEATURES OFFERED :</STRONG></H2>
      <h3><strong><em>Rent any car online</em></strong></h3>
      <h3><strong><em>Keep track of all your bookings : past, current and future</em></strong></h3>
      <h3><strong><em>Cancel your future booking online</em></strong></h3>
      <br>
      <br>
      <H2><strong> Start Now by Signing Up !</STRONG></H2>
</div>


<br>

    </div>
    
    <div class="col-md-3">
      <div class="panel panel-default">
          <div class="panel-heading text-center">REGISTER</div>

        <div class="panel-body">
<form action="signup-action.php" method="post">

      <div class="form-group">
      <input type="text" class="form-control"  placeholder="Name"   name="Cname">
      </div>

      <div class="form-group">
      <input type="email" class="form-control"  placeholder="Email address"  name="Cemail">
      </div>  

      <div class="form-group">
        <input type="password" class="form-control"  placeholder="Password"  name="Cpass">
      </div>

      <div class="form-group text-center">
          <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default active">
              <input type="radio" name="Cgender" id="option1" value="Female" autocomplete="off" checked> Female
            </label>
            <label class="btn btn-default">
              <input type="radio" name="Cgender" id="option2" value="Male" autocomplete="off"> Male
            </label>
            
          </div>
          </div>
      <div class="form-group">
      <input type="text" class="form-control"  placeholder="Address"   name="Caddress">
      </div>


      <div class="form-group">
      <input type="text" class="form-control"  placeholder="City"   name="Ccity">
      </div>


      <div class="form-group">
      <input type="text" class="form-control"  placeholder="Pincode"   name="Cpincode">
      </div>

      <div class="form-group">
      <input type="text" class="form-control"  placeholder="Contact Number"   name="Ccontactno">
      </div>

        <div class="text-center">
      <button type="submit" class="btn btn-success">Sign Up</button>
    </div>
  </form>



        </div>
      </div>
    </div>
  </div>

</div>
    <div class="footer navbar-fixed-bottom text-center bg_header" style="background-color:#000;color:#fff;">
        &copy; npn
      </div>
    </div>

</body>
</html>