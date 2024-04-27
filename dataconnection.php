<?php

$connect = mysqli_connect("localhost", "root", "", "jobstreet");

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}