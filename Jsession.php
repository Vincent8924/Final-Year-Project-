<?php

include("dataconnection.php");

session_start();
if (isset($_SESSION['id'])) {

    $id = $_SESSION['id'];

    $result = mysqli_query($connect, "SELECT * FROM jobseeker WHERE jobseeker_id = '$id'");
    
    if (!$result || mysqli_num_rows($result) == 0) 
    {
        echo"<script>alert('Please Login');window.location.href='login.php'</script>";
        exit;
    }

    
}
else 
{
    echo"<script>alert('Please Login');window.location.href='login.php'</script>";
    exit;
}

?>