<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobstreet";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Initialize variables for form input and errors
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
$reset_success = false;

// Get the email from the URL parameter
$email = $_GET['email'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate new password
    if (empty(trim($_POST["new-password"]))) {
        $new_password_err = "Please enter the new password.";     
    } else {
        $new_password = trim($_POST["new-password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm-new-password"]))) {
        $confirm_password_err = "Please confirm the new password.";     
    } else {
        $confirm_password = trim($_POST["confirm-new-password"]);
        if ($new_password != $confirm_password) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before updating the database
    if (empty($new_password_err) && empty($confirm_password_err)) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Prepare an update statement
        $sql = "UPDATE jobseeker SET jobseeker_password = ? WHERE jobseeker_email = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $param_password, $param_email);

            // Set parameters
            $param_password = $hashed_password; // Use hashed password
            $param_email = $email; // Use the email received from URL parameter

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Password updated successfully, set reset_success to true
                $reset_success = true;
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password2</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
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

        .form-container {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
            margin: 0 auto; /* Center the form horizontally */
            margin-top: 50px; /* Add space from the top */
        }

        .form-container h2 {
            margin-top: 0;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
        }

        .form-container input[type="email"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-container button[type="submit"] {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .form-container button[type="submit"]:hover {
            background-color: darkblue;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        /* Success message style */
        .success-message {
            background-color: lightgreen;
            color: green;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
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
        <a href="login.php">Sign In</a>
    </div>

    <div class="employer-site">
        <a href="#">Employer Site</a>
    </div>
</header>

<form class="form-container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h2>Reset Password</h2>

    <?php
    // Display new password error message
    if (!empty($new_password_err)) {
        echo "<p class='error'>$new_password_err</p>";
    }
    ?>

    <label for="new-password">New Password:</label>
    <input type="password" id="new-password" name="new-password" required>

    <?php
    // Display confirm password error message
    if (!empty($confirm_password_err)) {
        echo "<p class='error'>$confirm_password_err</p>";
    }
    ?>

    <label for="confirm-new-password">Confirm Password:</label>
    <input type="password" id="confirm-new-password" name="confirm-new-password" required>

    <button type="submit">Reset Password</button>
</form>


<script>
    // JavaScript code to display a pop-up window on successful password reset
    <?php if ($reset_success): ?>
    window.onload = function() {
        alert("Password reset successful!");
    }
    <?php endif; ?>
</script>


</body>
</html>