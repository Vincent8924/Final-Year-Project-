<?php

session_start();

// Check if user is logged in
if(!isset($_SESSION['email'])){
    // If user is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// Get user email from session
$user_email = $_SESSION['email'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobstreet";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Query to fetch saved job posts for the user
$sql = "SELECT * FROM saved_jobs WHERE user_email='$user_email'";
$result = $connect->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobSave Page</title>
    <style>
        /* Add your CSS styles here */
        header {
            background-color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navigation {
            display: inline-block;
            margin-left: 20px;
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

        .sign-in,
        .employer-site {
            display: inline-block;
            padding: 8px 16px;
            border: 2px solid blue;
            border-radius: 5px;
        }

        .sign-in a,
        .employer-site a {
            text-decoration: none;
            color: rgb(12, 12, 191);
        }

        .sign-in:hover,
        .employer-site:hover {
            background-color: blue;
        }

        .sign-in:hover a,
        .employer-site:hover a {
            color: white;
        }

        .logo {
            display: inline-block;
        }

        .logo img {
            height: 50px;
        }

        .navigation {
            display: inline-block;
            margin-left: 20px;
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

        .sign-in {
            display: inline-block;
            margin-left: auto;
            margin-right: 20px;
        }

        .employer-site {
            display: inline-block;
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
            <li><a href="#">Job Search</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Company Profile</a></li>
        </ul>
    </nav>

    <div class="sign-in">
        <a href="login.php">Sign In</a>
    </div>

    <div class="employer-site">
        <a href="#">Employer Site</a>
    </div>
</header>

<?php
    // Fetch and display saved job posts for the user
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Display saved job posts
        }
    } else {
        echo "No saved job posts.";
    }
    ?>

<!-- Your content goes here -->

</body>
</html>