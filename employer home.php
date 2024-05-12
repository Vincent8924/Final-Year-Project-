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


        <h1>Make a new post now!</h1>
        <br/><br/>
        <form class="formBox" name="addnewpost" method="post">
            
                <h1>Please fill in the information</h1>
                <br/>
                <h2>Job name?</h2>
                <input type="text" class="field" placeholder="What is the job?" name="job_name">

                <h2>Job type?</h2>
                
                <select class="field" name="job_type">
                            <option value="Accounting">Accounting</option>
                            
                            <option value="Administration & Office Support">Administration & Office Support</option>
                            <option value="Advertising, Atrs & Media">Advertising, Atrs & Media</option>
                            <option value="Banking & financial Services">Banking & financial Services</option>
                            <option value="Call Centre & Customer Service">Call Centre & Customer Service</option>
                            <option value="CEO & General Management">CEO & General Management</option>
                            <option value="Community Services & Development">Community Services & Development</option>
                            <option value="Construction">Construction</option>
                            <option value="Consulting & Strategy">Consulting & Strategy</option>
                            <option value="Design & Architecture">Design & Architecture</option>
                            <option value="Education & Traning">Education & Traning</option>
                            <option value="Engineering">Engineering</option>
                            <option value="Farming, Animals & Conservation">Farming, Animals & Conservation</option>
                            <option value="Government & Defence">Government & Defence</option>
                            <option value="Healthcare & Medical">Healthcare & Medical</option>
                            <option value="Hospitality & Tourism">Hospitality & Tourism</option>
                            <option value="Human Resources &Recruitment">Human Resources &Recruitment</option>
                            <option value="Information & Communication Technology">Information & Communication Technology</option>
                            <option value="Insurance & Superannuation">Insurance & Superannuation</option>
                            <option value="Legal">Legal</option>
                            <option value="Manufacturing, Transport & Logistics">Manufacturing, Transport &Logistics</option>
                            <option value="Marketing & Communications">Marketing & Communications</option>
                            <option value="Mining, Resources & Energy">Mining, Resources & Energy</option>
                            <option value="Real Estate & Property">Real Estate & Property</option>
                            <option value="Retail & Consumer Products">Retail & Consumer Products</option>
                            <option value="Sales">Sales</option>
                            <option value="Science & Technology">Science & Technology</option>
                            <option value="Self Employment">Self Employment</option>
                            <option value="Sport & Recreation">Sport & Recreation</option>
                            <option value="Trades & Services">Trades & Services</option>

                            
                        </select>



                <h2>Location?</h2>
                <input type="text" class="field" placeholder="Where is the location?" name="location">

                <h2>Employment type?</h2>
                <input type="text" class="field" placeholder="What employment type you need?" name="employment_type">
                
                <h2>Salary?</h2>
                <input type="text" class="field" placeholder="How much salary you can pay for this job?" name="salary">

                <h2>Description?</h2>
                <input type="text" class="field" placeholder="How about this job?" name="description">

                <br/><br/><hr/><br/><br/>
                <button type="submit"  name="post" value="post">Upload your draft</button>

        </form>


        <?php
     
        if (isset($_POST['post']))
        {
            $email = $_REQUEST["email"];
            $job = $_POST['job_name'];
            $type = $_POST['job_type'];
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
            mysqli_query($connect, "INSERT INTO `drafts` (`employer_email`,job_name,`job_type`,`location`,employment_type,`description`,salary) 
            VALUES('$email','$job','$type','$location','$et','$des', '$salary')");
       

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