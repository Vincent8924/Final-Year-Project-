<?php

$connect = mysqli_connect("localhost", "root", "", "employment");

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}