<?php
session_start();
include("dataconnection.php");


$new_password = $confirm_password = $email = "";
$new_password_err = $confirm_password_err = $email_err = "";
$reset_success = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    if (empty(trim($_POST["gmail"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["gmail"]);
    }

   
    if (empty(trim($_POST["new-password"]))) {
        $new_password_err = "Please enter the new password.";     
    } else {
        $new_password = trim($_POST["new-password"]);
    }

   
    if (empty(trim($_POST["confirm-new-password"]))) {
        $confirm_password_err = "Please confirm the new password.";     
    } else {
        $confirm_password = trim($_POST["confirm-new-password"]);
        if ($new_password != $confirm_password) {
            $confirm_password_err = "Password did not match.";
        }
    }

    
    if (empty($email_err) && empty($new_password_err) && empty($confirm_password_err)) {
       
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        
        $sql = "UPDATE jobseeker SET jobseeker_password = ? WHERE jobseeker_email = ?";

        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
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

        .form-container {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
            margin: 0 auto; 
            margin-top: 50px; 
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
    if (!empty($email_err)) {
        echo "<p class='error'>$email_err</p>";
    }
    ?>

    <label for="gmail">Gmail:</label>
    <input type="email" id="gmail" name="gmail" required>

    <?php
    if (!empty($new_password_err)) {
        echo "<p class='error'>$new_password_err</p>";
    }
    ?>

    <label for="new-password">New Password:</label>
    <input type="password" id="new-password" name="new-password" required>

    <?php

    if (!empty($confirm_password_err)) {
        echo "<p class='error'>$confirm_password_err</p>";
    }
    ?>

    <label for="confirm-new-password">Confirm Password:</label>
    <input type="password" id="confirm-new-password" name="confirm-new-password" required>

    <button type="submit">Reset Password</button>

    <?php
  
    if ($reset_success) {
        echo "<p class='success-message'>Password reset successful!</p>";
    }
    ?>
</form>

</body>
</html>