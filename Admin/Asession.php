<?php
include("../Admin/Adataconnection.php");

session_start();

if (isset($_SESSION['id'])) 
{
    $id = $_SESSION['id'];

    $result = mysqli_query($connect, "SELECT * FROM admin WHERE admin_id = '$id'");
    
    if (!$result || mysqli_num_rows($result) == 0) 
    {
        echo "<script>alert('Please Login');window.location.href='Alogin.php'</script>";
        exit;
    }
} 
else 
{
    echo "<script>alert('Please Login');window.location.href='Alogin.php'</script>";
    exit;
}
?>
