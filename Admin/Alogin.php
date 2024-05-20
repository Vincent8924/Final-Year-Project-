<?php 
    include("../Admin/Adataconnection.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="Alogin.css">
</head>
<body>
    <div class="aform">
        <div class="bform">
            <img src="../img/logo.png" class="logo"/>
            <h1>Admin Log-in</h1>
        </div>
        
        <form name="login" method="POST">
            <div class="cform">
                <input type="email" placeholder="Email" name="email" required><br>
                <input type="password" placeholder="Password" name="password" required><br>
                <button type="submit" name="login">Login</button>
            </div>
        </form> 
    </div>
    
    <?php
        if(isset($_POST['login'])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            
            $result = mysqli_query($connect,"SELECT * FROM admin WHERE admin_email='$email'");
            $row = mysqli_fetch_assoc($result);
            if($row)
            {
                session_start();
                if(password_verify($password, $row["admin_password"]))
                {
                    $_SESSION['id'] = $row["admin_id"];
                    echo'<script>alert("Login successful!");window.location.href="Adashboard.php";</script>';
                }
                else
                {
                    echo '<script>alert("Password invalid! Please Try Again!"); history.go(-1);</script>';
                }
            }
            else
            {
                echo '<script>alert("Admin does not exist!"); history.go(-1);</script>';
            }
        }
    ?>
</body>
</html>
