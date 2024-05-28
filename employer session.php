<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo"<script>alert('Please Login');window.location.href='employer login.php'</script>";
    exit;
}
?>