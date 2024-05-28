<?php include('vdataconnection.php'); ?>
<?php include('employer session.php'); ?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>
            Drafts | Job Help
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

    <h2>
        Your post quota : <?php echo " $balance";?>
    </h2> 

    <hr/>

    <h1>Manage your drafts</h1>
        <br/><br/>



        <?php


    $result = mysqli_query($connect, "SELECT * FROM drafts where `poster_id` = '$id'");	
    while($row = mysqli_fetch_assoc($result))
      {
      
      ?>	

          
        <div class="formbox">
            
            <h2>Drafts ID</h2>
            <?php echo $row['draft_id']?>

            <h2>Job name</h2>
            <?php echo $row['job_name']?>

            <h2>Company/Employer name</h2>
            <?php echo $row['company_name']?>

            <h2>Job type?</h2>
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

            <script>
        function edit()
        {
            console.log("Edit function called.");
            window.location = "employer edit post.php?did=<?php echo $row['draft_id'];?>";
        }
        </script>

            <form method="post" action="">
                  
                  <button type="button" onclick="edit()">Edit</button>
                     
                    <button type="submit" name="delete_id" onclick="return confirmation();">Delete</button>
                    
                    <input type="hidden" name="delete" value="<?php echo $row['draft_id']; ?>">

                    <button type="submit" name="post">Post</button>
                    <input type="hidden" name="pid" value="<?php echo $row['draft_id']; ?>">
                    
                    

                  </form>

        </div>
        <br/><br/><hr/><br/><br/>
           
        <?php
        }
        ?>

        <h1>Your post history</h1>
        <br/><br/>

        <?php


    $result = mysqli_query($connect, "SELECT * FROM post where `poster_id` = '$id'");	
    while($row = mysqli_fetch_assoc($result))
      {
      
      ?>	

          
        <div class="formbox">
            
            <h2>Drafts ID</h2>
            <?php echo $row['post_id']?>

            <h2>Job name</h2>
            <?php echo $row['job_name']?>

            <h2>Company/Employer name</h2>
            <?php echo $row['company_name']?>

            <h2>Job type?</h2>
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
            <form method="post" action="">
                  
                  
                     
                    <button type="submit" name="delete_post_id" onclick="return confirmation();">Delete post</button>
                    
                    <input type="hidden" name="delete_post" value="<?php echo $row['post_id']; ?>">

                   
                    
                    

                  </form>

        </div>
        <br/><br/><hr/><br/><br/>
           
        <?php
        }
        ?>

        


        <?php
              if (isset($_POST['delete_id'])) 
              {
                  $delete = $_POST['delete'];
                  mysqli_query($connect, "DELETE FROM drafts WHERE draft_id = '$delete'");
              
              ?>
              
              <script type="text/javascript">
                  alert("Drafts has been deleted!");
                  window.location = "employer drafts.php";
              </script> 
            
            
          <?php
           
              }
          ?>

<?php
              if (isset($_POST['delete_post_id'])) 
              {
                  $delete = $_POST['delete_post'];
                  mysqli_query($connect, "DELETE FROM post WHERE post_id = '$delete'");
              
              ?>
              
              <script type="text/javascript">
                  alert("Post has been deleted!");
                  window.location = "employer drafts.php";
              </script> 
            
            
          <?php
           
              }
          ?>


            <?php
              if (isset($_POST['post'])) 
              {
                $pid = $_POST['pid'];
                

                

                            
                $result = mysqli_query($connect, "SELECT * FROM employer WHERE id = '$id'");
                
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
                        window.location = "employer drafts.php";
                    }
                    else if(balance > 0)
                    {
                        answer = confirm("Do you want to post this post?");

                        if(answer == true)
                        {
                            alert("Your post is successfully posted.");
                            window.location = "employer drafts.php";

                        }
                        else if(answer != true)
                        {
                            window.location = "employer drafts.php";
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
                   
                    window.location = "employer drafts.php";

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
        
        </script>












    </body>