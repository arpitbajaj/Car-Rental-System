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
<!-- NAVIGATION BAR ENDS --><?php
  if(!isset($_SESSION)){
  session_start();
  }
?>

<?php
error_reporting(0);
if(isset($_POST['submit'])){
	$target_dir = "user_images/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        $uploadOk = 1;

                    $image= addslashes($_FILES["fileToUpload"]["tmp_name"]);
                    $name= addslashes($_FILES["fileToUpload"]["name"]);
                    $image= file_get_contents($image);
                    $image= basename( $_FILES["fileToUpload"]["tmp_name"]);
                    
                
	    } else {
	        $error = "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    $error = "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
	    $error = "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		if (file_exists($target_file)) {
		$error = "Sorry, file with same name already present.";
		}
		else
	    $error = "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		//include "dbConfig.php";

          //  $sql = "INSERT INTO `ps_image_details`(`user_id`, `filename`, `added_on`) VALUES ('{$_SESSION['u_id']}','{$_FILES['fileToUpload']['name']}','".time()."')";
	        //$query = mysqli_query($link,$sql);
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

	    	
	        $success = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
          saveimage($name,$image);
	        chmod($target_file, 0755);
	        header("Location: http://localhost/car/view-all-car.php");
      exit;
	    } else {
	        $error = "Sorry, there was an error uploading your file.";
	    }
	}
}
	function saveimage($name,$image)
            {
                $con=mysql_connect("localhost","root","");
                //$conn=mysql_connect("localhost","root","");
                mysql_select_db("car",$con);
                $vehicle_no=$_SESSION['vehicle_no'];
                $qry="insert into images_tbl(name,image,vehicle_no) values ('$name','$image','$vehicle_no')";
                $result=mysql_query($qry,$con);
                if($result)
                {
                    //echo "<br/>Image uploaded.";
                }
                else
                {
                    //echo "<br/>Image not uploaded.";
                }
            }


?>

<body>
	<div class="container">
		<?php if (isset($error)) {?>
		<p>
			<?php echo $error;?>
		</p>
		<?php }?>

		<form method="post" enctype="multipart/form-data" class="form">
		    	
		    	<div class="container">
			    <div class="form-group">
		    		<label for="exampleInputFile">Select image to upload:</label>
		    		<input type="file" name="fileToUpload" id="fileToUpload" accept="image/gif, image/jpeg">
			    	<p class="help-block">Only JPG/JPEG, GIF and PNG formats are supported.</p>
				</div>

		    	<input type="submit" value="Upload Image" name="submit" class="btn btn-info">
		    	</div>
			</form>
	</div>
</body>
</html>