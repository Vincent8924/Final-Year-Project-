<?php
include("Jsession.php");
include("dataconnection.php");

if (!$connect) {
    die("Database connection failed: " . mysqli_connect_error());
}
$firstName = '';

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $id = $connect->real_escape_string($id);

    $query = "SELECT jobseeker_firstname FROM jobseeker WHERE jobseeker_id = '$id'";
    $result = $connect->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row['jobseeker_firstname'];
    }
}

$wishlist = [];

if (isset($_SESSION['id'])) {
    $jobseeker_id = $_SESSION['id'];
    $jobseeker_id = $connect->real_escape_string($jobseeker_id);

    $query = "SELECT post.* FROM wishlist JOIN post ON wishlist.post_id = post.post_id WHERE wishlist.jobseeker_id = '$jobseeker_id'";
    $result = $connect->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $wishlist[] = $row;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="jobsave.css">
    <title>Your Wishlist</title>
    
</head>
<body>
    <header>
        <div class="logo">
        <img src="../Final-Year-Project-/general_image/jobhelper_logo.png" alt="JobStreet Logo">
        </div>
        <nav class="navigation">
            <ul>
            <li><a href="homepage.php?email=<?php echo urlencode($_SESSION['id']); ?>">Homepage</a></li>  
                <li><a href="jobsave.php?email=<?php echo urlencode($_SESSION['id']); ?>">Job Save</a></li>
                <li><a href="profile.php?email=<?php echo urlencode($_SESSION['id']); ?>">Profile</a></li>
                <li><a href="applylist.php?email=<?php echo urlencode($_SESSION['id']); ?>">Apply list</a></li>
            </ul>
        </nav>
        <div class="user-info" id="logoutBtn">
            <?php
            if (isset($firstName)) {
                echo '<p>Welcome, ' . $firstName . '</p>';
            }
            ?>
        </div>
        <div class="employer-site">
            <a href="employer sign up.php">Employer Site</a>
        </div>
    </header>
    <h1>Your Wishlist</h1>
    <div id="wishlistPosts">
        <?php
        if (count($wishlist) > 0) {
            foreach ($wishlist as $post) {
                $poster = ($post["poster_id"]);
                echo '<div class="jobPost" id="post_' . htmlspecialchars($post["post_id"]) . '">';

                $logogo = mysqli_query($connect,"SELECT * FROM employer_profile WHERE profile_id = '$poster'");
                $logogo_row = mysqli_fetch_assoc($logogo);

                echo '<img src="data:image/jpeg;base64,' . base64_encode($logogo_row["photo_data"]) . '" alt="logo">';
                echo '<h2>' . htmlspecialchars($post["company_name"]) . '</h2>';
                echo '<p>' . htmlspecialchars($post["job_name"]) . '</p>';
                echo '<p class="category">Category: ' . htmlspecialchars($post["category"]) . '</p>';
                echo '<p>Employment type: ' . htmlspecialchars($post["employment_type"]) . '</p>';
                echo '<p>Location: ' . htmlspecialchars($post["location"]) . '</p>';
                echo '<p>Salary: ' . htmlspecialchars($post["salary"]) . '</p>';
                echo '<p>Description: ' . htmlspecialchars($post["description"]) . '</p>';
                echo '<button class="applyButton" onclick="applyJob(' . htmlspecialchars($post["post_id"]) . ')">Apply</button>';
                echo '<button class="removeButton" onclick="removePost(' . htmlspecialchars($post["post_id"]) . ')">Remove</button>';
                echo '</div>';
            }
        } else {
            echo "No job posts in your wishlist.";
        }
        ?>
    </div>
    <footer>
        <nav>
            <ul>
            <li><a href="aboutus.php?email=<?php echo urlencode($_SESSION['id']); ?>">About us</a></li>
            <li><a href="contact.php?email=<?php echo urlencode($_SESSION['id']); ?>">Contact us</a></li>
            <li><a href="applylist.php?email=<?php echo urlencode($_SESSION['id']); ?>">Apply list</a></li>
            </ul>
        </nav>
    </footer>
    <script>
        function applyJob(postId) {
            window.location.href = 'apply.php?post_id=' + postId;
        }

        function removePost(postId) {
            if (confirm('Are you sure you want to remove this post from your wishlist?')) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "remove_from_wishlist.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        alert('Post removed successfully');
                        document.getElementById('post_' + postId).remove();
                    }
                };
                xhr.send("post_id=" + postId);
            }
        }

        document.getElementById('logoutBtn').addEventListener('click', function() {
            var confirmLogout = confirm('Are you sure you want to logout?');
            if (confirmLogout) {
                window.location.href = 'login.php';
            }
        });
    </script>
</body>
</html>
<?php
$connect->close();
?>