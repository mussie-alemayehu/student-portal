<?php
$hostname="localhost";
$userName="root";
$dbpassword="";
$dbName="signup_students";
$conn=mysqli_connect($hostname,$userName,$dbpassword,$dbName);
if(!$conn){
  die("Connection failed: ".mysqli_connect_error());
}

?>