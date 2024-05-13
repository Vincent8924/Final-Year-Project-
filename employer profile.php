<?php include('database_connection.php'); ?>
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
            $id = $_REQUEST['id'];

            if(isset($_POST['edit']))
            {
                header("Location:employer profile edit.php?id=" . urlencode($id));
                
            }
        ?>

    <?php
   
        $id = $_REQUEST["id"];
        


        
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