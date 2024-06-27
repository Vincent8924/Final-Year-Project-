<?php 
    include("../Admin/Adataconnection.php");
    include("../Admin/Asession.php");
    include("../Admin/Acheckreset.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="Alogin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="aform">
        <div class="bform">
            <img src="../general_image/jobhelper_logo.png" class="logo"/>
            <h1>OTP Varify</h1>
        </div>
        
        <form method="POST">
            <div class="cform">
                <input type="text" placeholder="OTP" name="otp" required><br>
                <button type="submit" name="verify">Verify</button>
            </div>
            
        </form> 
    </div>
    
    <?php
        $email = $_SESSION['email'];
        $sotp = $_SESSION['otp'];
        if(isset($_POST['verify'])) 
        {
            $otp = $_POST['otp'];
            if(!isset($sotp)) 
            {
                ?>
                    <script>
                        alert("sotp error");
                    </script>
                    <?php
                    exit();
            }
            if(!isset($otp)) 
            {
                ?>
                    <script>
                        alert("otp error");
                    </script>
                    <?php
                    exit();
            }
            if($otp == $sotp)
            {
                ?>
                <script>
                    alert("Verify sucessful! You can proccess to change password now");
                    window.location.href = "Aresetpassword.php";
                </script>
                <?php
            }
            else
            {
                ?>
                <script>
                    alert("Verify Unsucessful!");
                    history.go(-1);
                </script>
                <?php
            }
        }
    ?>
</body>
</html>