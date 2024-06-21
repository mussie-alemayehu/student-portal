<?php
$hostname="10.4.192.160";
$userName="root";
$dbpassword="";
$dbName="student_portal";
$conn=mysqli_connect($hostname,$userName,$dbpassword,$dbName);
if(!$conn){
  die("Connection failed: ".mysqli_connect_error());
}

?>