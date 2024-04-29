<?php
// Start session
session_start();

// Check if form is submitted
if(isset($_POST['submit'])){
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "jobstreet";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the user exists
    $sql = "SELECT * FROM jobseeker WHERE jobseeker_email='$email' AND jobseeker_password='$password'";
    $result = $conn->query($sql);

    // If user exists, redirect to homepage and store email in session
    if ($result->num_rows > 0) {
        // Start session
        $_SESSION['email'] = $email; // Store user's email in session
        // Check if user logged in with Gmail
        if(strpos($email, '@gmail.com') !== false) {
            $_SESSION['gmail'] = $email; // Store user's Gmail in session
        }
        header("Location: homepage.php"); // Redirect to homepage
        exit();
    } else {
        // If user does not exist, display login fail message
        $login_fail = true;
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | JobStreet</title>
    <style>
        body {
            background-image:url('3.jpg');
            background-repeat: no-repeat;
            background-size: 100% 160%;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: white; /* Set background color to white */
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
            color: #333; /* Set the color of the links */
            font-weight: bold; /* Make the links bold */
            transition: color 0.3s; /* Add transition effect for color change */
        }

        .navigation ul li a:hover {
            color: #555; /* Change the color on hover */
        }

        .sign-in,
        .employer-site {
            display: inline-block;
            padding: 8px 16px; /* Adjust padding as needed */
            border: 2px solid blue; /* Set border to blue */
            border-radius: 5px; /* Add border radius for rounded corners */
        }

        .sign-in a,
        .employer-site a {
            text-decoration: none;
            color: rgb(12, 12, 191); /* Set link color to blue */
        }

        .sign-in:hover,
        .employer-site:hover {
            background-color: blue; /* Change background color on hover */
        }

        .sign-in:hover a,
        .employer-site:hover a {
            color: white; /* Change link color on hover */
        }

        .logo {
            display: inline-block;
        }

        .logo img {
            height: 50px; /* Adjust height as needed */
        }

        .navigation {
            display: inline-block;
            margin-left: 20px; /* Add space between logo and navigation */
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
            margin-left: auto; /* Moves to the right */
            margin-right: 20px; /* Provides spacing between "Sign In" and "Employer Site" */
        }

        .employer-site {
            display: inline-block;
        }

        .container {
            max-width: 400px;
            margin: 150px auto; /* Adjust margin to lower the form */
            background-color: rgba(255, 255, 255, 0.8); /* Translucent white background */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .login-form {
            padding-top: 20px;
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .login-form input[type="email"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        .login-form button {
            width: 100%;
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-form button:hover {
            background-color: #0056b3;
        }

        .forget-password {
            font-size: 15px;
            text-align: center;
            margin-top: 20px; /* Move the forget password link above the button */
        }

        .forget-password a {
            color: blue;
            text-decoration: none;
        }

        .forget-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="JobStreet Logo">
        </div>

        <nav class="navigation">
            <ul>
                <li><a href="#">Job Search</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Company Profile</a></li>
            </ul>
        </nav>

        <div class="sign-in">
            <a href="register.php">Register</a> <!-- Update the href attribute -->
        </div>

        <div class="employer-site">
            <a href="#">Employer Site</a>
        </div>
    </header>

    <div class="container">
        <form class="login-form" action="login.php" method="POST">
            <h2>Login to Your Account</h2>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="submit">Login</button>
            <div class="forget-password">
                <a href="reset.php">Forgot Password?</a> <!-- Link to the reset.php page -->
            </div>
            <?php if(isset($login_fail) && $login_fail): ?>
                <p>Login failed. Please check your email and password.</p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>