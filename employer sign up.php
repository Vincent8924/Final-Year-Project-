<?php include('database_connection.php'); ?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>
            Sign up | Job Help
        </title>
        <link rel="stylesheet" type="text/css" href="employer login.css">
        <link rel="icon" href="img/logo.png">
    </head>
    
    <body>
    
    
    <?php
        if (isset($_POST['submit'])) {
           
            $email = $_POST["email"];
            $name = $_POST["name"];
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $confirmPassword = $_POST["confirmPassword"];

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
                mysqli_query($connect, "INSERT INTO employer(employer_email,employer_name,`password`,`balance`) VALUES ('$email', '$name','$password','0')");
                
                mysqli_query($connect, "INSERT INTO employer_profile(`employer_email`,`photo_name`,`photo_data`) SELECT text_data,file_name,photo_data FROM website_file");


                $result = mysqli_query($connect, "SELECT * FROM employer WHERE employer_email = '$email'");
                                

                    if ($result) 
                    {
                        $row = mysqli_fetch_assoc($result);
                        $id = $row['id'];
                        mysqli_free_result($result);
                    }

                                                                                
                mysqli_query($connect, "UPDATE employer_profile SET profile_id = $id, employer_email = '$email',name = '$name' WHERE employer_email = 'none'");
                ?>
                <script type="text/javascript">
                    alert("Registration successful. You can now proceed to log in.");
                    window.location.href = 'employer login.php';
                </script>
                <?php
            }
        }
    ?>




    <div id="form_container">
            <form class="form" method="post">

            <p id="heading">Sign up</p>


            <div class="field">
                <span class="material-symbols-outlined"> Email </span>
                <input name="email" autocomplete="off" placeholder="Please enter your Email" class="input-field" type="text"/>
            </div>

            <div class="field">
                <span class="material-symbols-outlined"> Name </span>
                <input name="name" autocomplete="off" placeholder="Account name" class="input-field" type="text"/>
            </div>

            <div class="field">
                <span class="material-symbols-outlined"> Password </span>
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
        

        <button class="full_button" type="submit" name="submit">Sign Up</button>
        <div>
                <button class="full_button" name="login">
                <a href="employer login.php">
                Login
                </a>
                </button>
                </div>
    
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

    </script>
</body>
    

</html>

