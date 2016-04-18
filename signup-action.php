<?php 

    $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') 

                    === FALSE ? 'http' : 'https';

    $host     = $_SERVER['HTTP_HOST'];
    $script   = $_SERVER['SCRIPT_NAME'];
    $currentUrl = $protocol . '://' . $host . $script;
  if(isset($_POST['Cname'])&&isset($_POST['Cemail'])&&isset($_POST['Cpass'])&&isset($_POST['Cgender'])
    &&isset($_POST['Caddress'])&&isset($_POST['Ccity'])&&isset($_POST['Cpincode'])&&isset($_POST['Ccontactno']) ) {

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

    $sql = "INSERT INTO customer (cname,cpassword,cemail,cgender,caddress,ccity,cpincode,ccontactno)
    VALUES ( '{$_POST['Cname']}', '{$_POST['Cpass']}' ,  '{$_POST['Cemail']}', 
       '{$_POST['Cgender']}' , '{$_POST['Caddress']}' , '{$_POST['Ccity']}' , '{$_POST['Cpincode']}' , '{$_POST['Ccontactno']}' )";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
      //  session_start();
       // $_SESSION['SUname']=$_POST['Cname'];
       // $_SESSION['SUphone']=$_POST['Cphone'];
       // $_SESSION["SUname"]=$_POST['Uname'];
        header("Location: http://localhost/car");
      exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        echo '<a href="index.php">back</a>';
      exit;
    }
    mysqli_close($conn);
  }

?>
