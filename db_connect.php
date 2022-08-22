<?php
// Create connection
$con = mysqli_connect("localhost", "root", "", "tes-multiple");

// Check conection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}
?>
