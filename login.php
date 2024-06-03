<?php
$jobseeker_id = isset($_SESSION['jobseeker_id']) ? $_SESSION['jobseeker_id'] : '';
    include("dataconnection.php");
    session_start();

    if(isset($_POST['submit'])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        $result = mysqli_query($connect,"SELECT * FROM jobseeker WHERE jobseeker_email='$email'");
        $row = mysqli_fetch_assoc($result);
        
        if($row) {
            if(password_verify($password, $row["jobseeker_password"])) {
                $_SESSION['id'] = $row["jobseeker_id"];
                if($_SESSION['id']) {
                    header("Location: homepage.php");
                    exit();
                } else {
                    echo '<script>alert("Session error!");</script>';
                }
            } else {
                echo '<script>alert("Password invalid! Please Try Again!"); history.go(-1);</script>';
            }
        } else {
            echo '<script>alert("User does not exist!"); history.go(-1);</script>';
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
            background-size: 100% 200%;
            font-family: 'Times New Roman', Times, serif;
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

        .sign-in{
            margin-left: 80%;
            display: inline-block;
            padding: 8px 16px;
            border: 2px solid blue;
            border-radius: 5px;
        }
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
            <img src="new.jpg" alt="JobStreet Logo">
        </div>

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
            <?php /*if (isset($login_fail) && $login_fail): ?>
                <p>Login failed. Please check your email and password.</p>
            <?php endif;*/ ?>
        </form>
    </div>
    <?php
    if(isset($_POST['submit'])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        
        $result = mysqli_query($connect,"SELECT * FROM jobseeker WHERE jobseeker_email='$email'");
        $row = mysqli_fetch_assoc($result);
        
        if($row) {
            if(password_verify($password, $row["jobseeker_password"])) {
                $_SESSION['id'] = $row["jobseeker_id"];
                if($_SESSION['id'])
                {
                    echo '<script>alert("Login successful!"); window.location.href="homepage.php";</script>';
                }
                else
                {
                    echo '<script>alert("Session!");;</script>';
                }
            } else {
                echo '<script>alert("Password invalid! Please Try Again!"); history.go(-1);</script>';
            }
        } else {
            echo '<script>alert("User does not exist!"); history.go(-1);</script>';
        }
    }
    
    ?>
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
