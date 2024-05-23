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
    <?php
                        {
                        $did = $_REQUEST["did"];
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

    <h1>Edit your post</h1>
        <br/><br/>
        <form class="formBox" name="addnewpost" method="post">
            
               
        <?php
     
     if (isset($_POST['edit']))
     {
         
         $did = $_REQUEST['did'];
         $id = $_REQUEST['id'];
         $job = $_POST['job_name'];
         $em_name = $_POST['company_name'];
         $type = $_POST['job_type'];
         $location = $_POST['location'];
         
         $et = $_POST['employment_type'];
         $salary = $_POST['salary'];
         $des = $_POST['description'];


             mysqli_query($connect, "UPDATE `drafts` SET
             job_name = '$job',
             company_name = '$em_name',
             category = '$type',
             `location` = '$location',
             employment_type = '$et',
             salary = '$salary',
             `description` = '$des'
             WHERE draft_id = '$did'");

        

             ?>
             <script type="text/javascript">
                 alert("Post Edit successfully!");
                 window.location = "employer drafts.php?id=<?php echo urlencode($id);?>";
                 
             </script>

             <?php
             
             
         }
     
 
     ?>


        <?php
		    if(isset($_REQUEST["did"]))
			{
			$did = $_REQUEST["did"];

			
		?>
                <h2>Job ID</h2>
                <?php echo $did ?>
                <br/><br/>

                <?php
    
                $result = mysqli_query($connect, "SELECT * FROM drafts where draft_id = '$did'");	
                $row = mysqli_fetch_assoc($result);
                
                
                ?>	

                

                <h2>Job name?</h2>
                <input type="text" class="field" placeholder="<?php echo $row['job_name']?>" name="job_name" value="<?php echo $row['job_name']?>">

                <h2>Company/Employer name</h2>
                <input type="text" class="field" placeholder="<?php echo $row['company_name']?>" name="company_name" value="<?php echo $row['company_name']?>">


                


                <h2>Job type?</h2>
                
                <select class="field" name="job_type">
                            <option value="<?php echo $row['category'] ?>"><?php echo $row['category'] ?></option>
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






        









    </body>