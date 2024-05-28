<?php
session_start();
if (!isset($_SESSION['jobseeker_email'])) {
    echo"<script>alert('Please Login');window.location.href='login.php'</script>";
    exit;
}
?>