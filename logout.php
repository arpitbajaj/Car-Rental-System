
 <?php
 if(!isset($_SESSION))
session_start();
?>
<!DOCTYPE html>
<html>
<body>
  <!--
<script>
$(function loggingOut(){
    $('a#logout').click(function(){
        if(confirm('Are you sure to logout')) {
            return true;
        }

        return false;
    });
});
</script>
-->
<?php


	session_unset();

// destroy the session
	session_destroy();

	header("Location: http://localhost/car/index.php");
			exit;
?>

</body>
</html>
