<?php
$servername = "localhost";
$username = " medizvsu_gurdwara";
$password = " KUfo$^I,s{d6";
$db_name = "medizvsu_gurdwara";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$db_name);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>