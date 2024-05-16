<?php
session_start();
include("dataconnection.php");

// Check if the user is logged in
if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Check if the job post ID is received through POST request
    if(isset($_POST['postId'])) {
        $postId = $_POST['postId'];

        // Prepare and execute SQL statement to insert the saved job post into the database
        $stmt = $connect->prepare("INSERT INTO saved_jobs (jobseeker_email, job_id) VALUES (?, ?)");
        $stmt->bind_param("si", $email, $postId);
        $stmt->execute();
        $stmt->close();

        // Respond with success message or any other response if needed
        echo "Job post saved successfully.";
    } else {
        // Respond with error message if no job post ID is received
        echo "Error: No job post ID received.";
    }
} else {
    // Respond with error message if user is not logged in
    echo "Error: User is not logged in.";
}

// Close database connection
$connect->close();
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
</body>
</html>