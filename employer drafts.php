<?php include('database_connection.php'); ?>
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
                        {
                        $email = $_REQUEST["email"];
                    ?>
        <nav>
            <div id="line">
                <div class="choice">
                    <span class="left">
                    <a href="employer home.php?home&email=<?php echo urlencode($email);?>"><img src="img/page logo2.png" id="page_logo"/></a>
                    </span>    
                    <span class="mid"> 

                    
                        <a href="employer home.php?home&email=<?php echo urlencode($email);?>">HOME</a>
                        <a href="employer drafts.php?draft&email=<?php echo urlencode($email);?>">Drafts</a>
                        <a href="employer packages.php?packages&email=<?php echo urlencode($email);?>">Package</a>
                        <a href="employer profile.php?profile&email=<?php echo urlencode($email);?>">Profile</a>
                    
                    </span>
                    <span class="right" >
                    <a href='index.php' onclick='return userconfirmation();'><img src='img/logout.png' style='width: 20px; height: 20px;'>LOG OUT</a></span> 
                    
                </div>
            </div>
        </nav>

        <?php
                        }
                    ?>
    <br/><hr/><br/>





        <?php
    $email = $_REQUEST["email"];
    $result = mysqli_query($connect, "SELECT * FROM drafts where `employer_email` = '$email'");	
   while($row = mysqli_fetch_assoc($result))
      {
      
      ?>	

          
        <div class="formbox">
            
            <h2>Drafts ID</h2>
            <?php echo $row['drafts_id']?>

            <h2>Job name</h2>
            <?php echo $row['job_name']?>

            <h2>Job type?</h2>
            <?php echo $row['job_type']?>    
                

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
                  
                  <button><a href="employer edit post.php?id&id=<?php echo $row['drafts_id'];?> &email=<?php echo urlencode($email);?>" class="white">Edit</a></button>
                     
                    <button type="submit" name="delete_id" onclick="return confirmation();">Delete</button>
                    
                    <input type="hidden" name="delete" value="<?php echo $row['drafts_id']; ?>">

                    <button type="submit" name="post">Post</button>
                    <input type="hidden" name="post_id" value="<?php echo $row['drafts_id']; ?>">
                    
                    

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
                  mysqli_query($connect, "DELETE FROM drafts WHERE drafts_id = '$delete'");
              
              ?>
              
              <script type="text/javascript">
                  alert("Drafts has been deleted!");
                  window.location = "employer drafts.php?delete&email=<?php echo urlencode($email);?>";
              </script> 
            
            
          <?php
           
              }
          ?>


            <?php
              if (isset($_POST['post'])) 
              {
                $p = $_POST['post'];
                $email = $_REQUEST["email"];
                
                $result = mysqli_query($connect, "SELECT balance FROM employer WHERE employer_email = '$email'");
                
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
                        window.location = "employer drafts.php?post&email=<?php echo urlencode($email);?>";
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
                            window.location = "employer drafts.php?post&email=<?php echo urlencode($email);?>";
                        }
                    }
                    

              </script>

          <?php
                if($balance != 0)
                {
                    $balance--;

                    mysqli_query($connect, "UPDATE employer SET balance = '$balance' WHERE employer_email = '$email'");
                    mysqli_query($connect, "INSERT INTO post(`employer_email`,job_name,`job_type`,`location`,employment_type,`description`,salary) 
                    SELECT `employer_email`,job_name,`job_type`,`location`,employment_type,`description`,salary FROM drafts WHERE employer_email = '$email' ");
                }
                
                ?>
                    
                <script>
                   
                    window.location = "employer drafts.php?email=<?php echo urlencode($email);?>";

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