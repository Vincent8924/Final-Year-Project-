<?php
session_start();
include("dataconnection.php");

if (isset($_POST['language']) && isset($_POST['email'])) {
    $language = $_POST['language'];
    $email = $_POST['email'];

    $query = $connect->prepare("INSERT INTO userprofile (email, language) VALUES (?, ?)");
    $query->bind_param("ss", $email, $language);
    if ($query->execute()) {
        echo "Language added successfully.";
    } else {
        echo "Error adding language: " . $query->error;
    }
}
?>