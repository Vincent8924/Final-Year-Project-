<?php include('vdataconnection.php'); 

    if(isset($_POST["forgot"])){

        $email = $_POST["email"];

        $sql = mysqli_query($connect, "SELECT * FROM employer WHERE employer_email = '$email'");
        $query = mysqli_num_rows($sql);
  	    $fetch = mysqli_fetch_assoc($sql);

        if(mysqli_num_rows($sql) <= 0){
            ?>
            <script>
                alert("<?php  echo "Sorry, no emails exists "?>");
            </script>
            <?php
        }else{
            // generate token by binaryhexa 
            $token = bin2hex(random_bytes(50));

            $otp = rand(100000,999999);
            $_SESSION['otp'] = $otp;


            session_start ();
            $_SESSION['token'] = $token;
            $_SESSION['email'] = $email;

            require "Mail/phpmailer/PHPMailerAutoload.php";
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->Port=587;
            $mail->SMTPAuth=true;
            $mail->SMTPSecure='tls';

            // h-hotel account
            $mail->Username='lojinkai@gmail.com';
            $mail->Password='iesz ctny gnma ntqc';

            // send by h-hotel email
            $mail->setFrom('Jolp Help', 'Password Reset');
            // get email from input
            $mail->addAddress($_POST["email"]);
            //$mail->addReplyTo('lamkaizhe16@gmail.com');

            // HTML body
            $mail->isHTML(true);
            $mail->Subject="Recover your password";
            $mail->Body = "<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>";


            if(!$mail->send()){
                echo "<script>alert('Fail to send OTP, please try again.');</script>";
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }else{
               
                echo "<script>alert('Send OTP successfully, OTP sent to $email'); window.location.replace('employer verify otp.php');</script>";
            }

        
        }
    }


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Reset Password | Job Help</title>
    <link rel="stylesheet" type="text/css" href="employer reset.css">
    <link rel="icon" href="general_image/jobhelper_logo.png">
</head>
<body>
    <header>
        <div class="logo">
            <img src="general_image/jobhelper_logo.png" alt="JobStreet Logo">
        </div>



        <div class="jobseeker-site">
            <a href="register.php">Jobseeker Site</a>
        </div>
    </header>

    <div id="form_container">
        <form class="form" method="post">
            <p id="heading">Your Email</p>
            <div class="field">
                <span class="material-symbols-outlined"> Email </span>
                <input name="email"  placeholder="Please enter your Email" class="input-field" type="text"/>
            </div>
           
            <div>
                <button class="full_button" type="submit" name="forgot">Send OTP</button>
            </div>
        </form>
    </div>



<footer>
        <nav>
            <ul>
                <li><a href="employer about us.php">About Us</a></li>
                <li><a href="employer contact us.php">Contact Us</a></li>
            </ul>
        </nav>
    </footer>
</body>
</html>