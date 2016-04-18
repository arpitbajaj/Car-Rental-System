
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

    $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') 

                    === FALSE ? 'http' : 'https';

    $host     = $_SERVER['HTTP_HOST'];
    $script   = $_SERVER['SCRIPT_NAME'];
    $currentUrl = $protocol . '://' . $host . $script;

 
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

    $sql = "DELETE FROM bookings where booking_id='{$_GET['booking_id']}' ";
          
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
        header("Location: http://localhost/car/cancel.php");
          
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    
?>
</body>
</html>