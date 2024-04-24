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
    <nav>
        <div id="line">
            <div class="choice">
                <span class="left">
                    <a href='employer home.php'><img src="img/page logo2.png" id="page_logo"/></a>
                </span>    
                <span class="mid"> 
                    <a href='employer home.php'>HOME</a>
                    <a href='employer drafts.php'>Drafts</a>
                    <a href='employer packages.php'>Package</a>
                    <a href='employer profile.php'>Profile</a>
                   
                </span>
                <span class="right" >
                <a href='index.php' onclick='return userconfirmation();'><img src='img/logout.png' style='width: 20px; height: 20px;'>LOG OUT</a></span> 
                
            </div>
        </div>
    </nav>
    <br/><hr/><br/>

    <h1>Edit your post</h1>
        <br/><br/>
        <form class="formBox" name="addnewpost" method="post">
            
               
        <?php
		    if(isset($_REQUEST["id"]))
			{
			$id = $_REQUEST["id"];
            $email = $_REQUEST['email'];
 
			
		?>
                <h2>Job ID</h2>
                <?php echo $_REQUEST['id']?>
                <br/><br/>

                <?php
    
                $result = mysqli_query($connect, "SELECT * FROM post where post_id = '$id'");	
                $row = mysqli_fetch_assoc($result);
                
                
                ?>	

                

                <h2>Job name?</h2>
                
                <input type="text" class="field" placeholder="<?php echo $row['job_name']?>" name="job_name" value="<?php echo $row['job_name']?>">
                

                <h2>Location?</h2>
                <input type="text" class="field" placeholder="<?php echo $row['location']?>" name="location" value="<?php echo $row['location']?>">

                <h2>Employment type?</h2>
                <input type="text" class="field" placeholder="<?php echo $row['employment_type']?>" name="employment_type" value="<?php echo $row['employment_type']?>">
                
                <h2>Salary?</h2>
                <input type="text" class="field" placeholder="<?php echo $row['salary']?>" name="salary" value="<?php echo $row['salary']?>">

                <h2>Description?</h2>
                <input type="text" class="field" placeholder="<?php echo $row['description']?>" name="description" value="<?php echo $row['description']?>">
                <br/><br/><hr/><br/><br/>
                <button type="submit" id="add" name="edit" value="Edit">Edit post</button>

                <?php

            }
            
    
        ?>
        </form>






        <?php
     
        if (isset($_POST['edit']))
        {
            $email = $_REQUEST['email'];
            $id = $_REQUEST['id'];
            $job = $_POST['job_name'];
            
            $location = $_POST['location'];
            
            $et = $_POST['employment_type'];
            $salary = $_POST['salary'];
            $des = $_POST['description'];


                mysqli_query($connect, "UPDATE `post` SET
                job_name = '$job',
                `location` = '$location',
                employment_type = '$et',
                salary = '$salary',
                `description` = '$des'
                WHERE post_id = '$id'");
   
           

                ?>
                <script type="text/javascript">
                    alert("Post Edit successfully!");
                    
                </script>

                <?php
                header("Location:employer drafts.php?edit&email=" . urlencode($email));
                
            }
        
    
        ?>









    </body>