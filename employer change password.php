<?php include('vdataconnection.php'); 

session_start();

//echo $_SESSION['email'];
//for test
?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>
        Reset Password | Job Help
        </title>
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
    
    
    <?php
        if (isset($_POST['reset'])) {
           
            $email = $_SESSION['email'];
            

            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $confirmPassword = $_POST["confirmPassword"];



            $registed = mysqli_query($connect,"SELECT * FROM `employer` WHERE employer_email = '$email'");

            $registed_email = mysqli_num_rows($registed);

            if($registed_email <= 0)
            {

            ?>
            <script>
                alert("This account does not registed!");
                window.location.replace("employer sign up.php");

            </script>

            <?php

            }
            else
            {
                if (strlen($_POST["password"]) < 8) {
                    ?>
                    <script>
                        alert("Password must be at least 8 characters long! Please Try again");
                        history.go(-1);
                    </script>
                    <?php
                } else if ($_POST["password"] !== $confirmPassword) {
                    ?>
                    <script>
                        alert("Password does not match! Please Try again");
                        history.go(-1);
                    </script>
                    <?php
                } else {
                    $result = mysqli_query($connect, "UPDATE employer SET `password` = '$password' WHERE employer_email = '$email'");

                    if($result)
                    {

                        session_destroy();
                        ?> 
                            <script>
                                alert("Set new password successfully!")
                                window.location.replace("employer login.php");
                            </script>
                    
                        <?php
                    }
                    else
                    {

                        session_destroy();
                        ?> 
                        
                            <script>
                                alert("Failed to set new password!")
                                window.location.replace("employer login.php");
                                delete 
                            </script>
                    
                        <?php
                    }
                                    ?>
                                    <script type="text/javascript">
                                        alert("Registration successful. You can now proceed to log in.");
                                        window.location.href = 'employer login.php';
                                    </script>
                                    <?php
                                }
                            }

                        }
    ?>




    <div id="form_container">
            <form class="form" method="post">

            <p id="heading">New Password</p>


  
            <div class="field">
                <span class="material-symbols-outlined"> New Password </span>
                <input name="password" placeholder="At least 8 number" class="input-field" type="password" required oninput="checkPasswordLength()"/>
            </div>

            <div class="field">
                <span class="material-symbols-outlined">Confirm Password</span>
                <input name="confirmPassword" placeholder="Please enter password again" class="input-field" type="password" required oninput="checkPasswordMatch()"/>
            </div>

            


        <div  class="alert">
            <p id="password-length-message"></p>
            <p id="password-confirm-message" ></p>
        </div>
        

        <button class="full_button" type="submit" name="reset">Reset your password</button>
  
    
            </form>
</div>

    <script>
        function checkPasswordMatch() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;
            var message = document.getElementById("password-confirm-message");

            if (password !== confirmPassword) {
                message.textContent = "Passwords do not match!";
            } else {
                message.textContent = "";
            }
        }
        function checkPasswordLength() {
            var password = document.getElementById("password").value;
            var message = document.getElementById("password-length-message"); 

            if (password.length < 8) {
                message.textContent = "Password must be at least 8 characters long!";
            } else {
                message.textContent = "";
            }
        }


        function login()
        {
            window.location = "employer login.php";
        }


    </script>
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

