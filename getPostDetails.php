<?php
include("dataconnection.php");

if (!$connect) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_GET['post_id'])) {
    $postId = $connect->real_escape_string($_GET['post_id']);

   
    $query = "SELECT post.*, employer_profile.photo_data 
              FROM post 
              JOIN employer_profile ON post.poster_id = employer_profile.profile_id 
              WHERE post.post_id = '$postId'";
              
    $result = $connect->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

       
        echo '<div class="slide-form-content">';
        echo '<img src="data:image/jpeg;base64,' . base64_encode($row["photo_data"]) . '" alt="Company Logo">';
        echo '<h2>' . htmlspecialchars($row["company_name"]) . '</h2>';
        echo '<p>' . htmlspecialchars($row["job_name"]) . '</p>';
        echo '<p>Category: ' . htmlspecialchars($row["category"]) . '</p>';
        echo '<p>Employment type: ' . htmlspecialchars($row["employment_type"]) . '</p>';
        echo '<p>Location: ' . htmlspecialchars($row["location"]) . '</p>';
        echo '<p>Salary: ' . htmlspecialchars($row["salary"]) . '</p>';
        echo '<p>Description: ' . htmlspecialchars($row["description"]) . '</p>';
        echo '</div>';
    } else {
        echo 'No details found for this post.';
    }
} else {
    echo 'Invalid post ID.';
}

$connect->close();
?>