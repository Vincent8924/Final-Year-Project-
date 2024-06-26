<?php include('vdataconnection.php'); ?>
<?php include('employer session.php'); ?>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>View Post | Job Help</title>
    <link rel="stylesheet" type="text/css" href="employer view post.css">
    <link rel="icon" href="general_image/jobhelper_logo.png">
  
  
</head>
<body>

    
    <?php
        $id = $_SESSION['id'];

        if(isset($_POST['logout']))
        {
            session_destroy();
            echo'<script>alert("Log-Out successful!");window.location.href="employer login.php";</script>';
        }
    ?>

    <header>
        <div class="logo">
            <a href="employer home.php"><img src="general_image/jobhelper_logo.png" id="page_logo"/></a>
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
        <form method="post">
            <button id="logout" name="logout" onclick='return userconfirmation();'><img src='img/logout.png' id="logout_photo">LOG OUT</button>
        </form>
    </header>

    <div class="center-container">
    <?php
        $result = mysqli_query($connect, "SELECT * FROM post");
        while($row = mysqli_fetch_assoc($result))
        {
            $poster = ($row["poster_id"]);
   

    $logogo = mysqli_query($connect,"SELECT * FROM employer_profile WHERE profile_id = '$poster'");
    $logogo_row = mysqli_fetch_assoc($logogo);

    
    ?>	
        <div class="formbox">
            <?php 
            if(!empty($logogo_row["photo_data"]))
            {
                echo '<img src="data:image/jpeg;base64,' . base64_encode($logogo_row["photo_data"]) . '" alt="logo" ">';
            }
            else
            {
                echo '<img src="img\default.png">';
            }
            ?>
        
            <h2>Post ID</h2>
            <?php echo $row['post_id']?>

            <h2>Job name</h2>
            <?php echo $row['job_name']?>

            <h2>Company/Employer name</h2>
            <?php echo $row['company_name']?>

            <h2>Job type</h2>
            <?php echo $row['category']?>

            <h2>Location</h2>
            <?php echo $row['location']?>

            <h2>Employment type</h2>
            <?php echo $row['employment_type']?>

            <h2>Salary</h2>
            <?php echo $row['salary']?>

            <h2>Description</h2>
            <?php echo $row['description']?>

            <br/><br/><br/><br/>
        </div>
    <?php
        }
    ?>
    </div>

    <?php
        if (isset($_POST['delete_id'])) 
        {
            $delete = $_POST['delete'];
            mysqli_query($connect, "DELETE FROM drafts WHERE draft_id = '$delete'");
    ?>
            <script type="text/javascript">
                alert("Drafts has been deleted!");
                window.location = "employer drafts.php?id=<?php echo urlencode($id);?>";
            </script> 
    <?php
        }
    ?>

    <?php
        if (isset($_POST['post'])) 
        {
            $pid = $_POST['pid'];
            $result= mysqli_query($connect, "SELECT * FROM employer WHERE id = '$id'");
            
            if ($result) 
            {
                $row = mysqli_fetch_assoc($result);
                $balance = $row['balance'];
                mysqli_free_result($result);
            }
    ?>
            <script>
                var balance = <?php echo $balance; ?>;
                console.log(balance);
                if(balance <= 0)
                {
                    alert("You have not enough balance to post");
                    window.location = "employer drafts.php?id=<?php echo urlencode($id);?>";
                }
                else if(balance > 0)
                {
                    answer = confirm("Do you want to post this post?");
                    if(answer == true)
                    {
                        alert("Your post is successfully posted.");
                    }
                    else if(answer != true)
                    {
                        window.location = "employer drafts.php?id=<?php echo urlencode($id);?>";
                    }
                }
            </script>
    <?php
                if($balance != 0)
                {
                    $balance--;
                    mysqli_query($connect, "UPDATE employer SET balance = '$balance' WHERE id = '$id'");
                    mysqli_query($connect, "INSERT INTO post(`post_id`,`poster_id`,job_name,`company_name`,`category`,`location`,employment_type,`description`,salary) 
                    SELECT `draft_id`,`poster_id`,job_name,`company_name`,`category`,`location`,employment_type,`description`,salary FROM drafts WHERE draft_id = '$pid'");
                }
    ?>
            <script>
                window.location = "employer drafts.php?id=<?php echo urlencode($id);?>";
            </script>
    <?php
        }
    ?>

    <script>
        function confirmation()
        {
            answer = confirm("Do you want to delete this post?");
            return answer;
        }

        function userconfirmation()
        {
            answer = confirm("Do you want to log out?");
            return answer;
        }
    </script>


<br/><br/><br/><br/>
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