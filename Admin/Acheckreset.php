<?php
include("../Admin/Adataconnection.php");


if (isset($_SESSION['startreset'])) 
{
} 
else 
{
    echo "<script>alert('Please Login');window.location.href='Alogin.php'</script>";
    exit;
}
?>
