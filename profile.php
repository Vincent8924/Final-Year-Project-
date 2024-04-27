<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile Page</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->

    <style>
        /* Your existing CSS styles here */

        /* Style for the user info container */
        .user-info-container {
            margin: 20px;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 5px;
            width: 300px;
        }
    </style>
</head>
<body>
    <header>
        <style>
            header {
                background-color: white;
                padding: 10px 20px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 2px solid #ccc; /* Add this line for the underline */
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

        <header>
            <div class="logo">
                <img src="logo.png" alt="JobStreet Logo">
            </div>

            <nav class="navigation">
                <ul>
                    <li><a href="homepage.php">Job Search</a></li>
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
    </header>

    <?php
    // Database connection
    $servername = "localhost";
    $username = "root"; // Replace with your database username
    $password = ""; // Replace with your database password
    $dbname = "jobstreet";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch user info
    session_start();
    $user_id = $_SESSION['user_id']; // Assuming you're storing user ID in session after login
    $sql = "SELECT jobseeker_firstname, jobseeker_lastname, jobseeker_email FROM jobseeker WHERE jobseeker_id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $full_name = $row["jobseeker_firstname"] . " " . $row["jobseeker_lastname"];
            $email = $row["jobseeker_email"];

            // Display user info within a container
            echo "<div class='user-info-container'>";
            echo "<p>Hello, $full_name</p>";
            echo "<p>$email</p>";
            echo "</div>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>

    <!-- Your other content goes here -->

</body>
</html>