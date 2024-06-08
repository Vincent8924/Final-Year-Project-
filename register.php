<?php
include("dataconnection.php");

if(isset($_POST['registerBtn'])) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (strlen($password) < 8) {
        echo '<script>alert("Password must be at least 8 characters long.");</script>';
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $result = mysqli_query($connect, "SELECT * FROM jobseeker WHERE jobseeker_email = '$email'");
        if(mysqli_num_rows($result) > 0) {
            echo '<script>
                    alert("Email already exists! Registration failed.");
                  </script>';
        } else {
            mysqli_query($connect, "INSERT INTO jobseeker (jobseeker_firstname, jobseeker_lastname, jobseeker_email, jobseeker_password) 
            VALUES ('$firstName', '$lastName', '$email', '$hashedPassword')");
            
            mysqli_query($connect, "INSERT INTO userprofile (`UserID`) SELECT jobseeker_id FROM jobseeker WHERE jobseeker_email = '$email'");
            ?>

            <script>
                alert("Registration successful");
                window.location = "login.php";
            </script>

           <?php
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="register.css">
    <title>Register | JobStreet</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="new.jpg" alt="JobStreet Logo">
        </div>
        <nav class="navigation">
            <ul>
            <li><a href="homepage.php?email=<?php echo urlencode($_SESSION['id']); ?>">Homepage</a></li>
            <li><a href="profile.php?email=<?php echo urlencode($_SESSION['id']); ?>">Profile</a></li>
            </ul>
        </nav>
        <div class="sign-in">
            <a href="login.php">Sign In</a>
        </div>
        <div class="employer-site">
            <a href="employer sign up.php">Employer Site</a>
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
                <input type="password" id="password" name="password" placeholder="Password" minlength="8" required>
                <span class="eye-icon" onclick="togglePasswordVisibility('password')">
                    <img src="eye.png" alt="Show/Hide Password">
                </span>
            </div>
            <div style="position: relative;">
                <input type="password" id="confirmPassword" placeholder="Confirm Password" minlength="8" required>
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

            if (password.length < 8) {
                alert("Password must be at least 8 characters long!");
                return false;
            }

            if (password !== confirmPassword) {
                alert("Password and Confirm Password do not match!");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>