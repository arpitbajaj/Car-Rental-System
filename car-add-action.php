
<?php 

    $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') 

                    === FALSE ? 'http' : 'https';

    $host     = $_SERVER['HTTP_HOST'];
    $script   = $_SERVER['SCRIPT_NAME'];
    $currentUrl = $protocol . '://' . $host . $script;
  if(isset($_POST['Vname'])&&isset($_POST['Vnumber'])&&isset($_POST['Vtype'])&&isset($_POST['Vcostperkm'])
    &&isset($_POST['Vmeterreading'])&&isset($_POST['Vrentalcost']) ) {

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
   
   
if(isset($_POST['submit'])){

  $sql = "INSERT INTO vehicle (vehicle_name,vehicle_number,vehicle_type,vehicle_costperkm,vehicle_meter_reading,vehicle_rentalcost)
    VALUES ( '{$_POST['Vname']}', '{$_POST['Vnumber']}' ,  '{$_POST['Vtype']}', 
       '{$_POST['Vcostperkm']}' , '{$_POST['Vmeterreading']}' , '{$_POST['Vrentalcost']}')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    
          if(!isset($_SESSION)){
          session_start();
          }
          

           $_SESSION['vehicle_no']=$_POST['Vnumber'];

      //  session_start();
       // $_SESSION['SUname']=$_POST['Cname'];
       // $_SESSION['SUphone']=$_POST['Cphone'];
       // $_SESSION["SUname"]=$_POST['Uname'];
        header("Location: http://localhost/car/uploadimage.php");
      exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        echo '<a href="index.php">back</a>';
      exit;
    }
}
    mysqli_close($conn);
}
?>