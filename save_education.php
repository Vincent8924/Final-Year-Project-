<?php
session_start();
include("dataconnection.php");

if (isset($_POST['education']) && isset($_POST['email'])) {
    $education = $_POST['education'];
    $email = $_POST['email'];

    $query = $connect->prepare("UPDATE userprofile SET education = ? WHERE jobseeker_email = ?");
    $query->bind_param("ss", $education, $email);
    if ($query->execute()) {
        echo "Education updated successfully.";
    } else {
        echo "Error updating education: " . $query->error;
    }
}