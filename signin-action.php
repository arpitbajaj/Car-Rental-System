
<!DOCTYPE html>
<html>
<head>
  <title>Welcome</title>
  <script src="jquery-2.1.3.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script type="text/javascript">
$( document ).ready(function() {
 $('#myAlert').on('closed.bs.alert', function () {
  // do something…
})
});
</script>
</head>
<body>


 <?php 

  if(($_POST['Cemail']=="admin@npn.com")&&($_POST['Cpass']=="npn"))
    {

            header("Location: http://localhost/car/home2.php");
            exit;
   }

    $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') 

                    === FALSE ? 'http' : 'https';

    $host     = $_SERVER['HTTP_HOST'];
    $script   = $_SERVER['SCRIPT_NAME'];
    $currentUrl = $protocol . '://' . $host . $script;

  if(isset($_POST['Cemail'])&&isset($_POST['Cpass'])) {

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

    $sql = "SELECT * FROM customer where cemail='{$_POST['Cemail']}' and cpassword= '{$_POST['Cpass']}'";
    $result=mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
         
          if(!isset($_SESSION)){
          session_start();
          }

           $_SESSION['SUname']=$row['cname'];
           $_SESSION['SUid']=$row["cid"];
         // echo 'enter!!!';
         // $_SESSION["SUname"]=$_POST['Uname'];
          header("Location: http://localhost/car/home.php");
          exit;
        }
    } 
    else 
    {
      ?>
<div class="bs-example">
    <div class="alert alert-danger alert-error">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong> Error in logging in!
    </div>
<?php
        echo '<a href="index.php">back</a>';
     //     header("Location: http://localhost/car/index.php");
      exit;
    }

    mysqli_close($conn);
    
  }

?>
</body>
</html>