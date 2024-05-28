<?php
session_start();
include("dataconnection.php");

if (isset($_FILES['profile_picture']) && isset($_SESSION['jobseeker_email'])) {
    $email = $_SESSION['jobseeker_email'];
    $profilePicture = $_FILES['profile_picture'];

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (in_array($profilePicture['type'], $allowedTypes) && $profilePicture['size'] <= 5000000) { // 5MB limit
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $uploadFile = $uploadDir . basename($profilePicture['name']);
        if (move_uploaded_file($profilePicture['tmp_name'], $uploadFile)) {
      
            $relativePath = 'uploads/' . basename($profilePicture['name']);
            
           
            $query = $connect->prepare("UPDATE userprofile SET ProfilePic = ? WHERE jobseeker_email = ?");
            $query->bind_param("ss", $uploadFile, $email);
            if ($query->execute()) {
                if ($query->affected_rows > 0) {
                    echo "Profile picture uploaded and database updated successfully.";
                } else {
                    echo "Profile picture uploaded but no database update. Check if the email exists in the database.";
                }
            } else {
                echo "Error updating profile picture: " . $query->error;
            }
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Invalid file type or size.";
    }
} else {
    echo "No file uploaded or session email not set.";
}
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    const uploaded = urlParams.get('profile_pic_uploaded');
    if (uploaded === '1') {
        alert("Profile picture uploaded successfully.");
    }
});
</script>