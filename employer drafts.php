<?php include('vdataconnection.php'); ?>
<?php include('employer session.php'); ?>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Drafts | Job Help</title>
    <link rel="stylesheet" type="text/css" href="employer draft.css">
    <link rel="icon" href="general_image/jobhelper_logo.png">
    
</head>
<body>
    <br/> <br/>

    <?php
        $id = $_SESSION['id'];

        if(isset($_POST['logout'])) {
            session_destroy();
            echo'<script>alert("Log-Out successful!");window.location.href="employer login.php";</script>';
        }

        $result = mysqli_query($connect,"SELECT * FROM employer WHERE id = '$id'");

        if($result) {
            $row = mysqli_fetch_assoc($result);
            $balance = $row['balance'];
            mysqli_free_result($result);
        }
    ?>

    <nav>
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
    </nav>

    <br/><hr/><br/>

    <div class="post-quota">
        <h2>Your post quota: <?php echo $balance; ?></h2>
    </div>


    <?php
            $result = mysqli_query($connect, "SELECT * FROM drafts where `poster_id` = '$id'");
           
            if(mysqli_num_rows($result) > 0)
            {
                ?>
                    <h1>Manage your drafts</h1>
                    <br/><br/>
                <?php
            }
            else
            {
                ?>
                    <div class="none_mid">
                    <b>Your have not any drafts now.</b>
                    <br/><br/><br/>
                    Let make your new draft now.
                    </div>
                   
                <?php
            }
        ?>

    

    <div class="formbox-container">
         <?php
            
            while($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="formbox">
                <div class="details">
                    <p>Drafts ID: <?php echo $row['draft_id']; ?></p>
                    <p><strong>Job name:</strong> <?php echo $row['job_name']; ?></p>
                    <p><strong>Company/Employer name:</strong> <?php echo $row['company_name']; ?></p>
                    <p><strong>Job type:</strong> <?php echo $row['category']; ?></p>
                    <p><strong>Location:</strong> <?php echo $row['location']; ?></p>
                    <p><strong>Employment type:</strong> <?php echo $row['employment_type']; ?></p>
                    <p><strong>Salary:</strong> <?php echo $row['salary']; ?></p>
                    <p><strong>Description:</strong> <?php echo $row['description']; ?></p>
                </div>

                <br/><br/><br/><br/>

                <?php

                if(isset($_POST['edit']))
                {
                    $did = $_POST['did'];
                    ?>
                    <script>
                            window.location = "employer edit post.php?did=<?php echo $row['draft_id'];?>";
                        
                    </script>
                <?php
                }
                
                ?>

                <form method="post">
                    <button type="submit" name="edit">Edit</button>
                    <input type="hidden" name="did" value="<?php echo $row['draft_id'];?>">
                    <button type="submit" name="delete_id" onclick="return confirmation();">Delete</button>
                    <input type="hidden" name="delete" value="<?php echo $row['draft_id']; ?>">
                    <button type="submit" name="post">Post</button>
                    <input type="hidden" name="pid" value="<?php echo $row['draft_id']; ?>">
                </form>
            </div>
            
            
        <?php
            }
        ?>
    
    <br/><br/><br/>


        </div>
    

    <?php
            $result = mysqli_query($connect, "SELECT * FROM post where `poster_id` = '$id'");
           
            if(mysqli_num_rows($result) > 0)
            {
                ?>
                <br/><br/>
                    <h1>Your post history</h1>
                    
                <?php
            }
        ?>

    
    <div class="formbox-container">
    


    <?php
    $result = mysqli_query($connect, "SELECT * FROM post where `poster_id` = '$id'");
    while($row = mysqli_fetch_assoc($result)) {
    ?>
        <div class="formbox">
            <div class="details">
                <p>Post ID: <?php echo $row['post_id']; ?></p>
                <p><strong>Job name:</strong> <?php echo $row['job_name']; ?></p>
                <p><strong>Company/Employer name:</strong> <?php echo $row['company_name']; ?></p>
                <p><strong>Job type:</strong> <?php echo $row['category']; ?></p>
                <p><strong>Location:</strong> <?php echo $row['location']; ?></p>
                <p><strong>Employment type:</strong> <?php echo $row['employment_type']; ?></p>
                <p><strong>Salary:</strong> <?php echo $row['salary']; ?></p>
                <p><strong>Description:</strong> <?php echo $row['description']; ?></p>
            </div>

            <br/><br/><br/><br/>



            <form method="post">
                
                <button type="submit" name="delete_post_id" onclick="return confirmation();">Delete</button>
                <input type="hidden" name="delete_post" value="<?php echo $row['post_id']; ?>">
               
            </form>
        </div>
    <?php
    }
    ?>
</div>



    <?php
        if (isset($_POST['delete_id'])) {
            $delete = $_POST['delete'];
            mysqli_query($connect, "DELETE FROM drafts WHERE draft_id = '$delete'");
    ?>
        <script type="text/javascript">
            alert("Drafts has been deleted!");
            window.location = "employer drafts.php";
        </script>
    <?php
        }

        if (isset($_POST['delete_post_id'])) {
            $delete = $_POST['delete_post'];
            mysqli_query($connect, "DELETE FROM post WHERE post_id = '$delete'");
    ?>
        <script type="text/javascript">
            alert("Post has been deleted!");
            window.location = "employer drafts.php";
        </script>
    <?php
        }

        if (isset($_POST['post'])) {
            $pid = $_POST['pid'];

            $posted = mysqli_query($connect, "SELECT * FROM post WHERE post_id = '$pid'");

            if(mysqli_num_rows($posted) > 0)
            {
                ?>
                <script>
                    alert("This post already existt!");
                    window.location = "employer drafts.php";
    
                </script>
    
                <?php
            }
            else
            {
            
            


            $result = mysqli_query($connect, "SELECT * FROM employer WHERE id = '$id'");

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $balance = $row['balance'];
                mysqli_free_result($result);
            }
    ?>
        <script>
            var balance = <?php echo $balance; ?>;
            console.log(balance);
            if(balance <= 0) {
                alert("You have not enough balance to post");
                window.location = "employer drafts.php";
            } else if(balance > 0) {
                answer = confirm("Do you want to post this post?");
                if(answer == true) {
                    alert("Your post is successfully posted.");
                    window.location = "employer drafts.php";
                } else if(answer != true) {
                    window.location = "employer drafts.php";
                }
            }
        </script>
    <?php
            if($balance != 0) {
                $balance--;
                mysqli_query($connect, "UPDATE employer SET balance = '$balance' WHERE id = '$id'");
                mysqli_query($connect, "INSERT INTO post(`post_id`,`poster_id`,job_name,`company_name`,`category`,`location`,employment_type,`description`,salary)
                SELECT `draft_id`,`poster_id`,job_name,`company_name`,`category`,`location`,employment_type,`description`,salary FROM drafts WHERE draft_id = '$pid'");
            
                    

        
        }
    ?>
        <script>
            window.location = "employer drafts.php";
        </script>
    <?php
        }}
    ?>

    <script>
        function confirmation() {
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