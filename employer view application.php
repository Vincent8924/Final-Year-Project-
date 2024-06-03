<?php include('vdataconnection.php'); ?>
<?php include('employer session.php'); ?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>
            Application | Job Help
        </title>
        <link rel="stylesheet" type="text/css" href="employer view applcation.css">
        <link rel="icon" href="img/logo.png">
        <style>

        </style>
    </head>
    <body>
    <br/> <br/>

    <?php
                        
                            $id = $_SESSION['id'];
                            

                            if(isset($_POST['logout']))
            {
                session_destroy();
                echo'<script>alert("Log-Out successful!");window.location.href="employer login.php";</script>';
            }


            $result = mysqli_query($connect,"SELECT * FROM employer WHERE id = '$id'");

            if($result)
            {
                $row = mysqli_fetch_assoc($result);
                $balance = $row['balance'];
                mysqli_free_result($result);
            }

                    ?>
        <header>
    <div class="logo">
        <a href="employer home.php"><img src="img/page logo2.png" id="page_logo"/></a>
    </div>
    <nav class="navigation">
        <ul>
            <li><a href="employer home.php">Home</a></li>
            <li><a href="employer drafts.php">Drafts</a></li>
            <li><a href="employer view post.php">Post</a></li>
            <li><a href="employer view application.php">Application</a></li>
            <li><a href="employer packages.php">Package</a></li>
            <li><a href="employer payment history.php">History</a></li>
            <li><a href="employer profile.php">Profile</a></li>
        </ul>
    </nav>
    <form method="post" >
       
            <button id="logout" name="logout" onclick='return userconfirmation();'><img src='img/logout.png' id="logout_photo">LOG OUT</button>
        </div> 
    </form>
</header>

                </div>
            </div>
        </nav>


    
    <br/><hr/><br/>

    <h1>Manage the application</h1>
        <br/><br/>