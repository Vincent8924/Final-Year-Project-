<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reset</title>
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
            transition: color 0.3s; /
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


        .form-container {
            max-width: 400px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px); 
            margin: 100px auto; 
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

        button:hover, 
        .button-clicked { 
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

        <button type="button" onclick="sendResetLink()" id="confirmButton">Confirm</button>
    </form>
</div>
<script src="https://smtpjs.com/v3/smtp.js"></script>
<script>
    function sendResetLink() {
        var userEmail = document.getElementById("email").value;

        if (validateEmail(userEmail)) {
            document.getElementById("confirmButton").classList.add("button-clicked"); 
            Email.send({
                Host: "smtp.elasticemail.com",
                Username: "gohchenghong533@gmail.com",
                Password: "28B7D947C5EA7004B173EC6DE795FAAED0DA",
                To: userEmail,
                From: "gohchenghong533@gmail.com",
                Subject: "Password Reset Link",
                Body: "Your account is requesting to change the password. Please verify whether this is your own operation. If so, please click <a href='http://localhost/f/reset2.php'>here</a> to complete the password change."
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