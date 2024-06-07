<?php
include("Jsession.php");
include("dataconnection.php");

if (!$connect) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['id']) && isset($_GET['post_id'])) {
    $jobseeker_id = $_SESSION['id'];
    $post_id = $_GET['post_id'];

    $jobseeker_id = $connect->real_escape_string($jobseeker_id);
    $post_id = $connect->real_escape_string($post_id);

    $query = "INSERT INTO wishlist (jobseeker_id, post_id) VALUES ('$jobseeker_id', '$post_id')";

    if ($connect->query($query) === TRUE) {
        echo "Job post saved to wishlist.";
    } else {
        echo "Error: " . $query . "<br>" . $connect->error;
    }
} else {
    echo "Invalid request.";
}

$connect->close();
?>