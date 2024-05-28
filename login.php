<?php
session_start();
include("dataconnection.php");


if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    $query = "SELECT jobseeker_password FROM jobseeker WHERE jobseeker_email = '$email'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['jobseeker_password'])) {
        
            if (strpos($email, '@gmail.com') !== false) {
                $_SESSION['gmail'] = $email;
            }

            header("Location: homepage.php");
            exit();
        } else {
            $login_fail = true;
        }
    } else {
        $login_fail = true;
    }
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
            background-image: url('3.jpg');
            background-repeat: no-repeat;
            background-size: 100% 160%;
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

        .container {
            max-width: 400px;
            margin: 150px auto;
            background-color: rgba(255, 255, 255, 0.8);
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
            margin-top: 20px;
        }

        .forget-password a {
            color: blue;
            text-decoration: none;
        }

        .forget-password a:hover {
            text-decoration: underline;
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
            <a href="register.php">Register</a>
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
                <a href="reset.php">Forgot Password?</a>
            </div>
            <?php if (isset($login_fail) && $login_fail): ?>
                <p>Login failed. Please check your email and password.</p>
            <?php endif; ?>
        </form>
    </div>
    <footer>
        <nav>
            <ul>
                <li><a href="aboutus.html">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </nav>
    </footer>
</body>
</html>