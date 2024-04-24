<?php include('database_connection.php'); ?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>
            Login | Job Help
        </title>
        <link rel="stylesheet" type="text/css" href="employer login.css">
        <link rel="icon" href="img/logo.png">
    </head>
    <body>
        <!--<a href="employer home.php">employer home<a>-->

        <div id="form_container">
            <form class="form" method="post">

                <p id="heading">Login</p>

                <div class="field">
                <span class="material-symbols-outlined"> Email </span>

                <input name="email" autocomplete="off" placeholder="Username" class="input-field" type="text"/>
                </div>

                <div class="field">
                    <span class="material-symbols-outlined"> Password </span>

                    <input name="password" autocomplete="off" placeholder="At least 8 number" class="input-field" type="password"/>
                </div>

                <div>
                <button class="half_button" name="login">
                    
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </button>
               
                
                <button class="half_button" name="sign up" >
                    <a href="employer sign up.php">
                        Sign Up
                    </a>
                </button>
                

                </div>
                
                <div>
                    <button class="full_button" name="forgot" >Forgot Password</button>
                </div>
            </form>
        </div>







        <?php
        if(isset($_POST['login'])) {
            $email = $_POST["email"];
            $result = mysqli_query($connect,"SELECT * FROM employer WHERE employer_email='$email'");
            $row = mysqli_fetch_assoc($result);
            if($row)
            {
                if(password_verify($_POST["password"],$row["password"]))
                {
                    echo'<script>alert("Login successful!");';
            
                    header("Location:employer home.php?login&email=" . urlencode($email));
                }
                else
                {
                    echo"<script>alert('Password invalid!'); history.go(-1);</script>;";
                }
                
                
            }
            else
            {
                echo"<script>alert('User does not exist!'); history.go(-1);</script>;";
            }

        }

       
    ?>




    </body>

</html>