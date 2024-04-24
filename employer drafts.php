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
                        <a href='employer home.php'><img src="img/page logo2.png" id="page_logo"/></a>
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
    $result = mysqli_query($connect, "SELECT * FROM post where `employer_email` = '$email'");	
   while($row = mysqli_fetch_assoc($result))
      {
      
      ?>	

          
        <div class="formbox">
            
            <h2>Post ID</h2>
            <?php echo $row['post_id']?>
            <h2>Job name</h2>
            <td><?php echo $row['job_name']?>
            <h2>Location</h2>
            <?php echo $row['location']?>
            <h2>Employment type</h2>
            <?php echo $row['employment_type']?>
            <h2>Salary</h2>
            <?php echo $row['salary']?></td>
            <h2>Description</h2>
            <?php echo $row['description']?>
            <br/><br/><br/><br/>
            <form method="post" action="">
                  
                  <button><a href="employer edit post.php?id&id=<?php echo $row['post_id'];?> &email=<?php echo urlencode($email);?>" class="white">Edit</a></button>
                     
                    <button type="submit" name="delete_id" onclick="return confirmation();">Delete</button>
                    
                    <input type="hidden" name="delete" value="<?php echo $row['post_id']; ?>">

                    <button type="submit" name="post">Post</button>

                    
                    

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
                  mysqli_query($connect, "DELETE FROM post WHERE post_id = '$delete'");
              
              ?>
              
              <script type="text/javascript">
                  alert("Post has been deleted!");
                 
              </script> 
            
            
          <?php
           header("Location:employer drafts.php?delete&email=" . urlencode($email));
              }
          ?>


            <?php
              if (isset($_POST['post'])) 
              {
                $email = $_REQUEST['email'];
                $result = mysqli_query($connect, "SELECT balance FROM balance WHERE employer_email = '$email'");
                
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
                        
                    }
                    else if(balance > 0)
                    {
                        answer = confirm("Do you want to post this post?");

                        if(answer == true)
                        {
                            alert("Your post is successfully posted.");
                            


                            
                        }
                    }
                    

              </script>

          <?php
                if($balance != 0)
                {
                    $balance--;
                }
                
                mysqli_query($connect, "UPDATE `balance` SET balance = '$balance' WHERE employer_email = '$email'");
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