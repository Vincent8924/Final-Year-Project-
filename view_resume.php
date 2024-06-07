<?php
include('dataconnection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $result = mysqli_query($connect, "SELECT Resume FROM jobseekerprofile WHERE jobseeker_id = '$id'");
    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Output the resume file
        header('Content-type: application/pdf');
        echo $row['Resume'];
        exit();
    }
}
?>