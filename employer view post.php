<?php include('vdataconnection.php'); ?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>
            View Post | Job Help
        </title>
        <link rel="stylesheet" type="text/css" href="employer home.css">
        <link rel="icon" href="img/logo.png">
    </head>
    <body>
    <br/> <br/>

    <?php
                        {
                        $id = $_REQUEST["id"];
                    ?>
        <nav>
            <div id="line">
                <div class="choice">
                    <span class="left">
                        <a href="employer home.php?id=<?php echo urlencode($id);?>"><img src="img/page logo2.png" id="page_logo"/></a>
                    </span>    
                    <span class="mid"> 

                    
                        <a href="employer home.php?id=<?php echo urlencode($id);?>">HOME</a>
                        <a href="employer drafts.php?id=<?php echo urlencode($id);?>">Drafts</a>
                        <a href="employer view post.php?id=<?php echo urlencode($id);?>">Post</a>
                        <a href="employer packages.php?id=<?php echo urlencode($id);?>">Package</a>
                        <a href="employer profile.php?id=<?php echo urlencode($id);?>">Profile</a>
                    
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
    $id = $_REQUEST["id"];

    $result = mysqli_query($connect, "SELECT * FROM post");	
    while($row = mysqli_fetch_assoc($result))
      {
      
      ?>	

          
        <div class="formbox">
            
            <h2>Post ID</h2>
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
                  window.location = "employer drafts.php?id=<?php echo urlencode($id);?>";
              </script> 
            
            
          <?php
           
              }
          ?>


            <?php
              if (isset($_POST['post'])) 
              {
                $pid = $_POST['pid'];
                $id = $_REQUEST["id"];

                

                            
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
        </script>












    </body>