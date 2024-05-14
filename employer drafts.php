<?php include('vdataconnection.php'); ?>
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

    $em = mysqli_query($connect, "SELECT * FROM employer WHERE id = '$id'");
                

    if ($em) 
    {
        $row = mysqli_fetch_assoc($em);
        $email = $row['employer_email'];
        mysqli_free_result($em);
    }
                
    $result = mysqli_query($connect, "SELECT balance FROM employer WHERE employer_email = '$email'");

    
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
                  
                  <button><a href="employer edit post.php?did=<?php echo $row['drafts_id'];?> &id=<?php echo $id ?>" class="white">Edit</a></button>
                     
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
                  window.location = "employer drafts.php?id=<?php echo urlencode($id);?>";
              </script> 
            
            
          <?php
           
              }
          ?>


            <?php
              if (isset($_POST['post'])) 
              {
                $p = $_POST['post'];
                $id = $_REQUEST["id"];

                $em = mysqli_query($connect, "SELECT employer_email FROM employer WHERE id = '$id'");
                            
                if ($em) 
                {
                    $row = mysqli_fetch_assoc($em);
                    $email = $row['employer_email'];
                    mysqli_free_result($em);
                }
                            
                $result = mysqli_query($connect, "SELECT balance FROM employer WHERE id = '$id'");
                
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

                    mysqli_query($connect, "UPDATE employer SET balance = '$balance' WHERE employer_email = '$email'");
                    mysqli_query($connect, "INSERT INTO post(`employer_email`,job_name,`job_type`,`location`,employment_type,`description`,salary) 
                    SELECT `employer_email`,job_name,`job_type`,`location`,employment_type,`description`,salary FROM drafts WHERE employer_email = '$email' ");
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