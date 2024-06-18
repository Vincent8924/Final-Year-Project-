<?php 
    include("../Admin/Adataconnection.php");
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="Aresetpassword.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="aform">
        <div class="bform">
            <img src="../general_image/jobhelper_logo.png" class="logo"/>
            <h1>Reset Password</h1>
        </div>
        
        <form method="POST">
            <div class="cform">
                <input type="password" placeholder="Password" name="password" id="password" oninput="checkPasswordLength()" required><br>
                <input type="password" placeholder="Confirm Password" name="cpassword" id="cpassword" oninput="checkPasswordMatch()" required><br>
                
                <div class="alert">
                    <p id="password-length-message"></p>
                    <p id="password-confirm-message"></p>
                </div>

                <button type="submit" name="reset">Reset</button>
            </div>
            
        </form> 
    </div>
    
    <?php
        $email = $_SESSION['email'];
        if(isset($_POST['reset'])) {
            $pw = $_POST["password"];
            $cpw = $_POST["cpassword"];
            $hpw = password_hash($_POST["password"], PASSWORD_DEFAULT);

            if (strlen($pw) < 8)
            {
                ?>
                <script>
                    alert("Unsucessful! The length for password must be at least 8 characters.");
                    history.go(-1);
                </script>
                <?php
            }
            else if($pw !== $cpw)
            {
                ?>
                <script>
                    alert("Unsucessful! The password doesn't match.");
                    history.go(-1);
                </script>
                <?php
            }
            else
            {
                $result = mysqli_query($connect,"UPDATE admin SET admin_password='$hpw' WHERE admin_email='$email'");
                ?>
                <script>
                    alert("Your email have been changed successfully.");
                    window.location.href = "Aprofile.php";
                </script>
                <?php
            }
            
        }
    ?>
</body>
</html>
<script>
    function checkPasswordMatch() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("cpassword").value;
        var message = document.getElementById("password-confirm-message");

        if (password !== confirmPassword) {
            message.textContent = "Passwords do not match!";
        }
        else {
            message.textContent = "";
        }
    }
    function checkPasswordLength() {
        var password = document.getElementById("password").value;
        var message = document.getElementById("password-length-message");
        if (password.length < 8) {
            message.textContent = "Password must be at least 8 characters long!";
        }
        else {
            message.textContent = "";
        }
    }
</script>