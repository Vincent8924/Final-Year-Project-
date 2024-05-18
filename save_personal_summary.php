<?php
session_start();
include("dataconnection.php");

if (isset($_POST['personal_summary']) && isset($_POST['email'])) {
    $personalSummary = $_POST['personal_summary'];
    $email = $_POST['email'];

    $query = $connect->prepare("UPDATE userprofile SET PersonalSummary = ? WHERE jobseeker_email = ?");
    $query->bind_param("ss", $personalSummary, $email);
    if ($query->execute()) {
        echo "Personal summary updated successfully.";
    } else {
        echo "Error updating personal summary: " . $query->error;
    }
} else {
    echo "Missing data. Please ensure both personal summary and email are provided.";
}
?>