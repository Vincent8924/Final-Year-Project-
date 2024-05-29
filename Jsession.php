<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo"<script>alert('Please Login');window.location.href='login.php'</script>";
    exit;
}
?>