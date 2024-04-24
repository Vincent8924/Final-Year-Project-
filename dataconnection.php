<?php
 
$connect = mysqli_connect("localhost","root","", "employment");

if (!$connect) {
  die("Connection failed: " . mysqli_connect_error());
}
 
?>