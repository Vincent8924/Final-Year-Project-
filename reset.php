<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
    <style>
         body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background: url('halo.jpg') center center fixed;
            background-size: cover;
            line-height: 1.6;
            color: #0c0b0b; 
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


        .form-container {
            max-width: 400px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px); 
            margin: 100px auto; /* Adjusted margin to move the form down */
        }

        h2 {
            text-align: center;
            color: #070606; 
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #070707; 
        }

        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            box-sizing: border-box;
            border: 1px solid #0d0c0c;
            border-radius: 4px;
            color: #070707; 
        }

        button {
            background-color: #f1f6f1;
            color: rgb(20, 14, 14);
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover, /* Add hover effect */
        .button-clicked { /* Class for when button is clicked */
            background-color: #a4d3ff;
        }

        .message {
            text-align: center;
            margin-bottom: 15px;
            color: #111010; 
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

<div class="form-container" id="resetForm">
    <h2>Reset Password</h2>
    <p class="message">Please enter your email address to verify is your own operation.</p>

    <form id="reset-password-form">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <button type="button" onclick="sendResetLink('<?php echo $email; ?>')" id="confirmButton">Confirm</button> <!-- Added id to the button -->
    </form>
</div>
<script src="https://smtpjs.com/v3/smtp.js"></script>
<script>
    function sendResetLink(email) {
        var userEmail = email;

        if (validateEmail(userEmail)) {
            document.getElementById("confirmButton").classList.add("button-clicked"); // Add class for hover effect
            Email.send({
                Host: "smtp.elasticemail.com",
                Username: "1211202786@student.mmu.edu.my",
                Password: "1A7A75F16100FF8A650865A7DF7FC1F180FB",
                To: userEmail,
                From: "1211202786@student.mmu.edu.my",
                Subject: "Password Reset Link",
                Body: "Your account is requesting to change the password. Please verify whether this is your own operation. If so, please click <a href='http://localhost/f/reset2.php?email=" + userEmail + "'>here</a> to complete the password change."
            }).then(
                function (message) {
                    if (message === "OK") {
                        alert("Password reset link sent successfully!");
                    } else {
                        console.error("Failed to send email:", message);
                        alert("Failed to send password reset link. Please try again later.");
                    }
                }
            ).catch(
                function (error) {
                    console.error("Error:", error);
                    alert("An error occurred while sending the email. Please try again later.");
                }
            );
        } else {
            alert("Please enter a valid email address.");
        }
    }

    function validateEmail(email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }
</script>
</body> 
</html>