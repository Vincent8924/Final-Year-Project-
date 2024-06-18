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
    <link rel="stylesheet" type="text/css" href="login.css">
    <title>Login | JobStreet</title>
   
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
            <a href="employer index.php">Employer Site</a>
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
   
</body>
</html>
