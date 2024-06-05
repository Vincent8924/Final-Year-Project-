<?php
include("Jsession.php");
include("dataconnection.php");

if (!$connect) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_POST['post_id']) && isset($_SESSION['id'])) {
    $postId = $connect->real_escape_string($_POST['post_id']);
    $jobseekerId = $connect->real_escape_string($_SESSION['id']);

    $query = "DELETE FROM wishlist WHERE post_id = '$postId' AND jobseeker_id = '$jobseekerId'";
    if ($connect->query($query) === TRUE) {
        echo "Post removed successfully";
    } else {
        echo "Error: " . $connect->error;
    }
}

$connect->close();
?>