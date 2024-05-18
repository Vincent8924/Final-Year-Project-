<?php
session_start();
include("dataconnection.php");

if (isset($_POST['work_experience']) && isset($_POST['email'])) {
    $workExperience = $_POST['work_experience'];
    $email = $_POST['email'];

    $query = $connect->prepare("UPDATE userprofile SET work_experience = ? WHERE jobseeker_email = ?");
    $query->bind_param("ss", $workExperience, $email);
    if ($query->execute()) {
        echo "Work experience updated successfully.";
    } else {
        echo "Error updating work experience: " . $query->error;
    }
}
?>