<?php include('vdataconnection.php'); ?>
<?php include('employer session.php'); ?>
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
            
            $id = $_SESSION['id'];
            
            
            if(isset($_POST['logout']))
            {
                session_destroy();
                echo'<script>alert("Log-Out successful!");window.location.href="employer login.php";</script>';
            }
        
        ?>

<header>
    <div class="logo">
        <a href="employer home.php"><img src="img/page logo2.png" id="page_logo"/></a>
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
    <form method="post" >
       
            <button id="logout" name="logout" onclick='return userconfirmation();'><img src='img/logout.png' id="logout_photo">LOG OUT</button>
        </div> 
    </form>
</header>

                </div>
            </div>
        </nav>


   
<br/><br/>
<form class="formBox" name="addnewpost" method="post">
    <h1>Lets make a new post now and fill in the information</h1>
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
                <button type="submit"  name="post" value="post">Save your draft</button>

        </form>


        <?php
     
        if (isset($_POST['post']))
        {
            
            $job = $_POST['job_name'];
            $type = $_POST['job_type'];
            $location = $_POST['location'];
            
            $et = $_POST['employment_type'];
            $salary = $_POST['salary'];
            $des = $_POST['description'];

            $result = mysqli_query($connect, "SELECT * FROM employer WHERE id = '$id'");
                
                if ($result) 
                {
                    $row = mysqli_fetch_assoc($result);
                    $em_name = $row['employer_name'];
                    mysqli_free_result($result);
                }
        

           
            if(empty($job) || empty($location) || empty($et) || empty($salary)) {
                ?>
                <script>
                    alert("Please fill in all fields.");
                </script>
                <?php
            } 
        
           
            else
            {
            mysqli_query($connect, "INSERT INTO `drafts` (`poster_id`,`company_name`,job_name,`category`,`location`,employment_type,`description`,salary) 
            VALUES('$id','$em_name','$job','$type','$location','$et','$des', '$salary')");
       

                ?>
                <script type="text/javascript">
                    alert("Your post is be save to the drafts page now.");
                    window.location = "employer home.php";
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