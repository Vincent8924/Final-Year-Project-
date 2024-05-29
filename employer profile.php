<?php include('vdataconnection.php'); ?>
<?php include('employer session.php'); ?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>
            Profile | Job Help
        </title>
        <link rel="stylesheet" type="text/css" href="employer profile.css">
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

    <?php 


            if(isset($_POST['edit']))
            {
                header("Location:employer profile edit.php?id=" . urlencode($id));
                
            }
        ?>

    <?php
   
 
        


        
        $result = mysqli_query($connect, "SELECT * FROM employer_profile where profile_id = '$id'");	


        if ($result) {
        while($row = mysqli_fetch_assoc($result))
        {
    ?>

    <div id="profile_photo_space" >
    
    <img id="profile_photo" src="data:image/png;base64,<?php echo base64_encode($row['photo_data']); ?>" alt="Photo">
    </div>
    

    <br/><br/><br/>
    




    <div class="profile">
    <b>Employer/Company name</b> 
    <br/><br/>
    <?php echo $row['name'] ?>
    
    </div>

    <br/><br/>

    <div class="profile">
    <b>Website</b> 
    <br/><br/>
    <?php echo $row['website'] ?>
    
    </div>

    <br/><br/>

    <div class="profile">
    <b>industry</b>
    <br/><br/>
    <?php echo $row['industry'] ?>
    
    </div>

    <br/><br/>

    <div class="profile">
    <b>Company Size</b>
    <br/><br/>
    <?php echo $row['company_size'] ?>
    
    </div>

    <br/><br/>

    <div class="profile">
    <b>Primary location</b>
    <br/><br/>
    <?php echo $row['primary_location'] ?>
    
    </div>

    <br/><br/>

    <div class="profile">
    <b>Description</b>
    <br/><br/>
    <?php echo $row['description'] ?>
    
    </div>
    <?php



}
}

?>
    

    <br/><br/><br/><br/>
    <form  method="post">
    <button type="submit" name="edit">Edit profile</button>

    </form>


        






</div>
<br/><br/><br/><br/>
    </body>


    
</html>