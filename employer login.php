<?php include('vdataconnection.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Login | Job Help</title>
    <link rel="stylesheet" type="text/css" href="employer login.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="JobStreet Logo">
        </div>

        <nav class="navigation">
            <ul>
                <li><a href="#">AAA</a></li>
                <li><a href="#">AAA</a></li>
                <li><a href="#">AAA</a></li>
            </ul>
        </nav>

        <div class="jobseeker-site">
            <a href="register.php">Jobseeker Site</a>
        </div>
    </header>

    <div id="form_container">
        <form class="form" method="post">
            <p id="heading">Login</p>
            <div class="field">
                <span class="material-symbols-outlined"> Email </span>
                <input name="email"  placeholder="Please enter your Email" class="input-field" type="text"/>
            </div>
            <div class="field">
                <span class="material-symbols-outlined"> Password </span>
                <input name="password" autocomplete="off" placeholder="Password" class="input-field" type="password"/>
            </div>
            <div>
                <button class="half_button" name="login">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                <button class="half_button" name="sign up"><a href="employer sign up.php">Sign Up</a></button>
            </div>
            <div>
                <button class="full_button" name="forgot">Forgot Password</button>
            </div>
        </form>
    </div>

    <?php
    if(isset($_POST['login'])) {
        $email = $_POST["email"];
        $result = mysqli_query($connect,"SELECT * FROM employer WHERE employer_email='$email'");
        $row = mysqli_fetch_assoc($result);

        if($row) {
            session_start();
            if(password_verify($_POST["password"],$row["password"])) {
                $_SESSION['id'] = $row["id"];
                echo'<script>alert("Login successful!");window.location.href="employer home.php";</script>';
            } else {
                echo"<script>alert('Password invalid!'); history.go(-1);</script>;";
            }
        } else {
            echo"<script>alert('User does not exist!'); history.go(-1);</script>;";
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