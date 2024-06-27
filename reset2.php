<?php 
include('dataconnection.php'); 
session_start();

//echo $_SESSION['email'];
//for test


    if(isset($_POST["verify"])){
        $otp = $_SESSION['otp'];
        $email = $_SESSION['jobseeker_email'];
        $otp_code = $_POST['otp_code'];



        if($otp != $otp_code){
            ?>
           <script>
               alert("Invalid OTP code");
           </script>
           <?php
        }else{
           
            

            ?>
             <script>
                 alert("Please enter your new password.");
                   window.location.replace("change_password.php");
             </script>
             <?php
        }

    }

?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<!doctype html>
<html lang="en">
<head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  
   

    <link rel="stylesheet" type="text/css" href="reset.css">

    <link rel="icon" href="general_image/jobhelper_logo.png">

  
    

    <title>Reset Password | Job Help</title>
</head>
<body>

<header>
        <div class="logo">
            <img src="general_image/jobhelper_logo.png" alt="JobStreet Logo">
        </div>



        <div class="jobseeker-site">
            <a href="employer index.php">Employer Site</a>
        </div>
    </header>

    <div id="form_container">
        <form class="form" method="post">
            <p id="heading">Verify OTP</p>
            <div class="field">
                <span class="material-symbols-outlined"> OTP </span>
                <input name="otp_code"  placeholder="Please enter the otp " class="input-field" type="text"/>
            </div>
           
            <div>
                <button class="full_button" type="submit" name="verify">Verify</button>
            </div>
        </form>
    </div>



<footer>
        <nav>
            <ul>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="contact us.php">Contact Us</a></li>
            </ul>
        </nav>
    </footer>
</body>
</html>
