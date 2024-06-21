<?php
// $hostname="10.4.117.69:8080";
$hostname ="localhost:8080";
$userName="root";
$dbpassword="";
$dbName="student_portal";
$conn=mysqli_connect($hostname,$userName,$dbpassword,$dbName);
if(!$conn){
  die("Connection failed: ".mysqli_connect_error());
}

?>