<?php
session_start();
include("dataconnection.php");

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $email = $connect->real_escape_string($email);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_id'])) {
        $post_id = intval($_POST['post_id']);

        $check_query = "SELECT favourite FROM post WHERE post_id = $post_id";
        $check_result = $connect->query($check_query);

        if ($check_result->num_rows > 0) {
            $row = $check_result->fetch_assoc();
            $new_status = ($row['favourite'] == 'yes') ? 'no' : 'yes';

            
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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navigation {
            display: inline-block;
            margin-right: 50%;
        }

        .navigation ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .navigation ul li {
            display: inline-block;
            margin-right: 20px;
        }

        .navigation ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            transition: color 0.3s;
        }

        .navigation ul li a:hover {
            color: #555;
        }

        .employer-site {
            display: inline-block;
            padding: 8px 16px;
            border: 2px solid blue;
            border-radius: 5px;
            margin-left: 20px;
        }

        .employer-site a {
            text-decoration: none;
            color: rgb(12, 12, 191);
        }

        .employer-site:hover {
            background-color: blue;
        }

        .employer-site:hover a {
            color: white;
        }

        .logo {
            display: inline-block;
        }

        .logo img {
            height: 50px;
        }

        .user-info {
            display: inline-block;
            padding: 8px 16px;
            border: 2px solid green;
            border-radius: 5px;
            margin-left: 50px;
        }

        .user-info p {
            margin: 0;
            font-weight: bold;
            color: green;
        }

        .user-info:hover {
            background-color: green;
        }

        .user-info:hover p {
            color: white;
        }

        #jobPosts {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            padding: 20px;
            margin-top: 20px;
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

        .jobPost:last-child {
            margin-right: 0;
        }

        .jobPost:hover {
            background-color: #e0e0e0;
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

        @media (max-width: 1000px) {
            .jobPost {
                width: calc(45% - 20px);
            }
        }

        @media (max-width: 600px) {
            .jobPost {
                width: calc(100% - 20px);
            }
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

        .applyButton {
            background-color: purple;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px; 
            cursor: pointer;
            border-radius: 5px;
        }

        .applyButton:hover {
            background-color: plum;
        }

        .applyButton:active {
            background-color: plum;
            transform: translateY(1px); 
        }

        footer {
            background-color: white;
            padding: 10px 20px;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0px -1px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        footer nav ul {
            font-family: 'Times New Roman', Times, serif;
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 20px;
        }

        footer nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            transition: color 0.3s;
        }

        footer nav ul li a:hover {
            color: #555;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="Company Logo">
        </div>
        <nav class="navigation">
            <ul>
                <li><a href="homepage.php?email=<?php echo urlencode($_SESSION['email']); ?>">Homepage</a></li>
                <li><a href="profile.php?email=<?php echo urlencode($_SESSION['email']); ?>">Profile</a></li>
                <li><a href="#">Company Profile</a></li>
            </ul>
        </nav>
        <div class="user-info">
            <?php
            if (isset($firstName)) {
                echo '<p>Welcome, ' . $firstName . '</p>';
            }
            ?>
        </div>
        <div class="employer-site">
            <a href="#">Employer Site</a>
        </div>
    </header>
    
    <div id="jobPosts">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $savedClass = ($row["favourite"] === 'yes') ? 'saved' : '';
                echo '<div class="jobPost" id="post_' . htmlspecialchars($row["post_id"]) . '">';
                echo '<img src="' . htmlspecialchars($row["logo"]) . '" alt="logo">';
                echo '<h2>' . htmlspecialchars($row["company_name"]) . '</h2>';
                echo '<p>' . htmlspecialchars($row["job_name"]) . '</p>';
                echo '<p class="category">Category: ' . htmlspecialchars($row["category"]) . '</p>';
                echo '<p>Employment type: ' . htmlspecialchars($row["employment_type"]) . '</p>';
                echo '<p>Location: ' . htmlspecialchars($row["location"]) . '</p>';
                echo '<p>Salary: ' . htmlspecialchars($row["salary"]) . '</p>';
                echo '<p>Description: ' . htmlspecialchars($row["description"]) . '</p>';
                echo '<button class="applyButton" onclick="applyJob(' . htmlspecialchars($row["post_id"]) . ')">Apply</button>';
                echo '<span class="saveIcon ' . $savedClass . '" onclick="toggleFavouriteJobPost(this, ' . htmlspecialchars($row["post_id"]) . ')">&#10084;</span>';
                echo '</div>';
            }
        } else {
            echo "No saved job posts available";
        }
        ?>
    </div>
    <footer>
        <nav>
            <ul>
               
                <li><a href="companies.php">Companies</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </footer>
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

        function applyJob(postId) {
          
            window.location.href = 'apply.php?post_id=' + postId;
        }
    </script>
</body>
</html>
<?php
$connect->close();
?>