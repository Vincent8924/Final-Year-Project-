<?php
session_start();
include("dataconnection.php");

if (isset($_POST['language']) && isset($_POST['email'])) {
    $language = $_POST['language'];
    $email = $_POST['email'];

  
    $checkQuery = $connect->prepare("SELECT * FROM userprofile WHERE jobseeker_email = ?");
    $checkQuery->bind_param("s", $email);
    $checkQuery->execute();
    $result = $checkQuery->get_result();

    if ($result->num_rows > 0) {
        
        $updateQuery = $connect->prepare("UPDATE userprofile SET language = ? WHERE jobseeker_email = ?");
        $updateQuery->bind_param("ss", $language, $email);
        if ($updateQuery->execute()) {
            echo "Language updated successfully.";
        } else {
            echo "Error updating language: " . $updateQuery->error;
        }
    } else {
       
        $insertQuery = $connect->prepare("INSERT INTO userprofile (email, language) VALUES (?, ?)");
        $insertQuery->bind_param("ss", $email, $language);
        if ($insertQuery->execute()) {
            echo "Language added successfully.";
        } else {
            echo "Error adding language: " . $insertQuery->error;
        }
    }
}


?>