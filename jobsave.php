<?php
session_start();
include("dataconnection.php");

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $email = $connect->real_escape_string($email);

    // Handle AJAX request to toggle favourite status
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_id'])) {
        $post_id = intval($_POST['post_id']);

        // Check current favourite status
        $check_query = "SELECT favourite FROM post WHERE post_id = $post_id";
        $check_result = $connect->query($check_query);

        if ($check_result->num_rows > 0) {
            $row = $check_result->fetch_assoc();
            $new_status = ($row['favourite'] == 'yes') ? 'no' : 'yes';

            // Update favourite status
            $update_query = "UPDATE post SET favourite = '$new_status' WHERE post_id = $post_id";
            if ($connect->query($update_query) === TRUE) {
                echo json_encode(['status' => 'success', 'favourite' => $new_status]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update favourite status.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Post not found.']);
        }
        $connect->close();
        exit();
    }

    // Fetch favourite job posts
    $query = "SELECT * FROM post WHERE favourite = 'yes'";
    $result = $connect->query($query);
} else {
    echo "Please log in to view your saved job posts.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Job Posts</title>
    <style>
        /* Add your styles here */
        body {
            font-family: Arial, sans-serif;
        }
        .jobPost {
            position: relative;
            width: calc(30% - 20px);
            margin-bottom: 20px;
            margin-right: 10px;
            background-color: #f9f9f9;
            border: 2px solid purple;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .jobPost img {
            width: 100%;
            border-radius: 5px 5px 0 0;
        }
        .jobPost h2 {
            font-size: 18px;
            margin-top: 10px;
            margin-bottom: 5px;
        }
        .jobPost p {
            font-size: 14px;
            margin-top: 5px;
            margin-bottom: 5px;
        }
        .saveIcon {
            position: absolute;
            bottom: 5px;
            right: 5px;
            font-size: 20px;
            color: black;
            cursor: pointer;
        }
        .saved {
            color: red; 
        }
    </style>
</head>
<body>
    <header>
        <h1>Saved Job Posts</h1>
    </header>
    <div id="savedJobPosts">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $savedClass = ($row["favourite"] === 'yes') ? 'saved' : '';
                echo '<div class="jobPost" id="post_' . htmlspecialchars($row["post_id"]) . '">';
                echo '<img src="' . htmlspecialchars($row["logo"]) . '" alt="logo">';
                echo '<h2>' . htmlspecialchars($row["company_name"]) . '</h2>';
                echo htmlspecialchars($row["job_name"]);
                echo '<p class="category">Category: ' . htmlspecialchars($row["category"]) . '</p>'; 
                echo '<p>Employment type: ' . htmlspecialchars($row["employment_type"]) . '</p>';
                echo '<p>Location: ' . htmlspecialchars($row["location"]) . '</p>';
                echo '<p>Salary: ' . htmlspecialchars($row["salary"]) . '</p>';
                echo '<p>Description: ' . htmlspecialchars($row["description"]) . '</p>';
                echo '<span class="saveIcon ' . $savedClass . '" onclick="toggleFavouriteJobPost(this, ' . htmlspecialchars($row["post_id"]) . ')">&#10084;</span>'; 
                echo '</div>';
            }
        } else {
            echo "No saved job posts available";
        }
        ?>
    </div>
    <script>
        function toggleFavouriteJobPost(icon, postId) {
            const request = new XMLHttpRequest();
            request.open('POST', 'jobsave.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    if (response.status === 'success') {
                        if (response.favourite === 'yes') {
                            icon.classList.add('saved');
                        } else {
                            icon.classList.remove('saved');
                        }
                    } else {
                        alert(response.message);
                    }
                }
            };
            request.send('post_id=' + postId);
        }
    </script>
</body>
</html>
<?php
$connect->close();
?>