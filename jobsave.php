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
    <title>Your Wishlist</title>
    <style>
 body {
            font-family: 'Times New Roman', Times, serif;
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

        #wishlistPosts {
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

        .jobPost:las
        .jobPost:nth-child(2) {
            margin-left: auto;
        }

        .jobPost:hover {
            background-color: #e0e0e0;
        }

        .jobPost img {
            width: 30%;
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

        #searchContainer {
            display: flex;
            align-items: center;
            width: 80%;
            margin: 20px auto 0;
        }

        #searchBar {
            flex: 1;
            padding: 10px;
            border: 1px solid black;
            border-radius: 5px 0 0 5px;
        }

        #categorySelector {
            padding: 10px;
            border: 1px solid black;
            border-left: none;
            border-radius: 0 5px 5px 0;
            background-color: #fff;
            cursor: pointer;
        }

        #categorySelector:focus {
            outline: none;
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
.removeButton {
    background-color: red;
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

.removeButton:hover {
    background-color: darkred;
}

.removeButton:active {
    background-color: darkred;
    transform: translateY(1px);
}


    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="new.jpg" alt="Company Logo">
        </div>
        <nav class="navigation">
            <ul>
                <li><a href="homepage.php?email=<?php echo urlencode($_SESSION['id']); ?>">Homepage</a></li>
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
                echo '<div class="jobPost" id="post_' . htmlspecialchars($post["post_id"]) . '">';
                echo '<img src="data:image/jpeg;base64,' . base64_encode($post["logo"]) . '" alt="logo">';
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
                <li><a href="aboutus.html">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="applylist.php">Apply list</a></li>
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