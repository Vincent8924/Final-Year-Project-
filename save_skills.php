<?php
session_start();
include("dataconnection.php");

if (isset($_POST['skills']) && isset($_POST['email'])) {
    $skills = $_POST['skills'];
    $email = $_POST['email'];

    $query = $connect->prepare("UPDATE userprofile SET skills = ? WHERE jobseeker_email = ?");
    $query->bind_param("ss", $skills, $email);
    if ($query->execute()) {
        echo "Skills updated successfully.";
    } else {
        echo "Error updating skills: " . $query->error;
    }
}
?>