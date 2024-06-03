<?php
include("dataconnection.php");

if(isset($_POST['registerBtn'])) {
    $firstName = mysqli_real_escape_string($connect, $_POST["firstName"]);
    $lastName = mysqli_real_escape_string($connect, $_POST["lastName"]);
    $email = mysqli_real_escape_string($connect, $_POST["email"]);
    $password = mysqli_real_escape_string($connect, $_POST["password"]);

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $check_query = "SELECT * FROM jobseeker WHERE jobseeker_email = '$email'";
    $result = mysqli_query($connect, $check_query);
    if(mysqli_num_rows($result) > 0) {
        echo '<script>
                alert("Email already exists! Registration failed.");
              </script>';
    } else {
        $query = "INSERT INTO jobseeker (jobseeker_firstname, jobseeker_lastname, jobseeker_email, jobseeker_password) 
                  VALUES ('$firstName', '$lastName', '$email', '$hashedPassword')";

        if(mysqli_query($connect, $query)) {
            echo '<script>
                    alert("Registration successful");
                  </script>';
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($connect);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | JobStreet</title>
    <style>
        body {
            background-image: url('1.jpg');
            background-repeat: no-repeat;
            background-size: 100% 120%;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
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

        .container {
            max-width: 400px;
            margin: 50px auto;        
            background-color: rgba(255, 255, 255, 0.8); 
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            
        }

        .register-form {
            padding-top: 20px;
            position: relative;
        }

        .register-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .register-form input[type="text"],
        .register-form input[type="email"],
        .register-form input[type="password"] {
            width: 100%;
            padding: 10px 35px 10px 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        .eye-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 10px;
            cursor: pointer;
        }

        .eye-icon img {
            width: 15px;
            vertical-align: middle;
        }

        .register-form label {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .register-form label input[type="checkbox"] {
            margin-right: 10px;
            align-self: flex-start;
        }

        .register-form button {
            width: 100%;
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .register-form button:hover {
            background-color: #0056b3;
        }

        
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="new.jpg" alt="JobStreet Logo">
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
    <div class="container">
        <form class="register-form" method="post" onsubmit="return validateForm()">
            <h2>Create Your Account</h2>
            <input type="text" name="firstName" placeholder="First Name" required>
            <input type="text" name="lastName" placeholder="Last Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <?php if(!empty($emailExistError)) { ?>
                <div style="color: red;"><?php echo $emailExistError; ?></div>
            <?php } ?>
            <div style="position: relative;">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <span class="eye-icon" onclick="togglePasswordVisibility('password')">
                    <img src="eye.png" alt="Show/Hide Password">
                </span>
            </div>
            <div style="position: relative;">
                <input type="password" id="confirmPassword" placeholder="Confirm Password" required>
                <span class="eye-icon" onclick="togglePasswordVisibility('confirmPassword')">
                    <img src="eye.png" alt="Show/Hide Password">
                </span>
            </div>
            <label>
                <input type="checkbox" required>
                <span style="font-size: 12px;">I agree to JH's privacy policy and acknowledge that my personal information may be gathered, saved, and used as specified by registering. As stated in the Privacy Policy, I also consent to receive marketing communications from JobHelp and its affiliates. I may withdraw my consent at any time by using the unsubscribe instructions.</span>
            </label>
            <button type="submit" name="registerBtn">Sign Up</button>
        </form>
    </div>

    <script>
        function togglePasswordVisibility(inputId) {
            var x = document.getElementById(inputId);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                alert("Password and Confirm Password do not match!");
                return false; 
            }
            return true; 
        }
    </script>
</body>
</html>