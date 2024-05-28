<?php include('vdataconnection.php'); ?>
<?php include('employer session.php'); ?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>
            Application | Job Help
        </title>
        <link rel="stylesheet" type="text/css" href="employer home.css">
        <link rel="icon" href="img/logo.png">
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
        <nav>
            <div id="line">
                <div class="choice">
                    <span class="left">
                        <a href="employer home.php"><img src="img/page logo2.png" id="page_logo"/></a>
                    </span>    
                    <span class="mid"> 

                    
                    <a href="employer home.php">HOME</a>
                        <a href="employer drafts.php">Drafts</a>
                        <a href="employer view post.php">Post</a>
                        <a href="employer view application.php">Application</a>
                        <a href="employer packages.php">Package</a>
                        <a href="employer payment history.php">History</a>
                        <a href="employer profile.php">Profile</a>
                    
                    </span>
                    <form method="post" >
                        <span class="right" >
                            <button id="logout" name="logout" onclick='return userconfirmation();'><img src='img/logout.png' id="logout_photo">LOG OUT</button>
                        </span> 
                    </form>
                </div>
            </div>
        </nav>

    
    <br/><hr/><br/>

    <h1>Manage the application</h1>
        <br/><br/>