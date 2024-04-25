<?php include('database_connection.php'); ?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>
            Home | Job Help
        </title>
        <link rel="stylesheet" type="text/css" href="employer home.css">
        <link rel="icon" href="img/logo.png">
    </head>
    <body>

  

        <br/><br/>
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


        <h1>Make a new post now!</h1>
        <br/><br/>
        <form class="formBox" name="addnewpost" method="post">
            
                <h1>Please fill in the information</h1>
                <br/>
                <h2>Job name?</h2>
                <input type="text" class="field" placeholder="What is the job?" name="job_name">
                <h2>Location?</h2>
                <input type="text" class="field" placeholder="Where is the location?" name="location">
                <h2>Employment type?</h2>
                <input type="text" class="field" placeholder="What employment type you need?" name="employment_type">
                <h2>Salary?</h2>
                <input type="text" class="field" placeholder="How much salary you can pay for this job?" name="salary">

                <h2>Description?</h2>
                <input type="text" class="field" placeholder="How about this job?" name="description">
                <br/><br/><hr/><br/><br/>
                <button type="submit"  name="post" value="post">Add Order</button>

        </form>


        <?php
     
        if (isset($_POST['post']))
        {
            $email = $_REQUEST["email"];
            $job = $_POST['job_name'];
            
            $location = $_POST['location'];
            
            $et = $_POST['employment_type'];
            $salary = $_POST['salary'];
            $des = $_POST['description'];
        

           
            if(empty($job) || empty($location) || empty($et) || empty($salary)) {
                ?>
                <script>
                    alert("Please fill in all fields.");
                </script>
                <?php
            } 
        
           
            else
            {
            mysqli_query($connect, "INSERT INTO `post` (`employer_email`,job_name,`location`,employment_type,`description`,salary) 
            VALUES('$email','$job','$location','$et','$des', '$salary')");
       

                ?>
                <script type="text/javascript">
                    alert("Your post is be save to the drafts page now.");
                    
                </script>

                <?php

            }
        }
    
        ?>



    </body>
    <script>
        function userconfirmation()
        {
            answer = confirm("Do you want to log out?");
            return answer;
        }
    </script>
</html>