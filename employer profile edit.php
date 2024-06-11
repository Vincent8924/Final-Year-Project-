<?php include('vdataconnection.php'); ?>
<?php include('employer session.php'); ?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>
            Profile | Job Help
        </title>
        <link rel="stylesheet" type="text/css" href="employer profile.css">
        <link rel="icon" href="general_image/jobhelper_logo.png">
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
        <header>
            <div class="logo">
                <a href="employer home.php"><img src="general_image/jobhelper_logo.png" id="page_logo"/></a>
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
            <form method="post">
                <button id="logout" name="logout" onclick='return userconfirmation();'><img src='img/logout.png' id="logout_photo">LOG OUT</button>
            </form>
        </header>
    </nav>
        

    <br/><br/><br/><br/>

    <div id="subbody">
    <?php
   
        
        


        
        $result = mysqli_query($connect, "SELECT * FROM employer_profile where profile_id = '$id'");	
        if ($result) {
        while($data = mysqli_fetch_assoc($result))
        {
    ?>

    <div id="profile_photo_space" >
    
    <img id="profile_photo" src="data:image/png;base64,<?php echo base64_encode($data['photo_data']); ?>" alt="Photo">
    </div>
    



       

    <br/><br/><br/>
    <div class="mid">

    <form  method="post" enctype="multipart/form-data">
    <input type="file" name="photo" accept="image/*">



    <br/><br/><br/><br/>

    <div class="profile">
    Employer/Company name 
    <br/><br/>
    <input type="text" name="name" placeholder="<?php echo $data['name'] ?>" value="<?php echo $data['name'] ?>">
    </div>

    <br/><br/>

    <div class="profile">
    Website 
    <br/><br/>
    <input type="text" name="website" placeholder="<?php echo $data['website'] ?>" value="<?php echo $data['website'] ?>">
    </div>

    <br/><br/>

    <div class="profile">
    industry
    <br/><br/>
    <input type="text" name="industry" placeholder="<?php echo $data['industry'] ?>" value="<?php echo $data['industry'] ?>">
    </div>

    <br/><br/>

    <div class="profile">
    Company Size
    <br/><br/>
    <input type="text" name="size" placeholder="<?php echo $data['company_size'] ?>" value="<?php echo $data['company_size'] ?>">
    </div>

    <br/><br/>

    <div class="profile">
    Primary location
    <br/><br/>
    <input type="text" name="location" placeholder="<?php echo $data['primary_location'] ?>" value="<?php echo $data['primary_location'] ?>">
    </div>

    <br/><br/>

    <div class="profile">
    Description
    <br/><br/>
    <input type="text" name="description" placeholder="<?php echo $data['description'] ?>" value="<?php echo $data['description'] ?>">
    </div>

    <br/><br/><br/><br/>
    <button type="submit" name="submit">Upload Profile</button>

    </form></div>

    <?php
}
}

?>



<?php

if(isset($_POST['submit'])) {
    
    $fileName = "profile_photo";
    $fileTmpName = $_FILES['photo']['tmp_name'];

    $name = $_POST['name'];
    $website = $_POST['website'];
    $industry = $_POST['industry'];
    $size = $_POST['size'];
    $location = $_POST['location'];
    $des = $_POST['description'];

    
    //$fileData = file_get_contents($fileTmpName);
 
    
    //mysqli_query($connect, "DELETE FROM employer_profile WHERE employer_email = '$email'");



    //$stmt = mysqli_prepare($connect, "INSERT INTO employer_profile (employer_email,photo_name, photo_data) VALUES (?, ?, ?)");
    //mysqli_stmt_bind_param($stmt, "sss", $email, $fileName, $fileData);

    if(empty($fileTmpName))
    {
        

        $stmt = mysqli_prepare($connect, "UPDATE employer_profile SET `name` = ?,website = ?,industry = ?,company_size = ?,primary_location = ?,`description` = ? WHERE profile_id = '$id'");

        mysqli_stmt_bind_param($stmt, "ssssss", $name, $website,$industry,$size,$location,$des);
    }
    else
    {
        $pname = 'profile_photo';
        $fileData = file_get_contents($fileTmpName);
        $stmt = mysqli_prepare($connect, "UPDATE employer_profile SET `name` = ?,photo_name = ?,photo_data = ?,website = ?,industry = ?,company_size = ?,primary_location = ?,`description` = ? WHERE profile_id = '$id'");

        mysqli_stmt_bind_param($stmt, "ssssssss", $name, $pname, $fileData, $website,$industry,$size,$location,$des);
    }

   



    //header("Location:employer profile.php?upload&email=" . urlencode($email));
    //at first I plan to put this to let user after change the profile photo can achieve the same effect with refresh web page
    //but does not work


    if(mysqli_stmt_execute($stmt)) {
        ?>
        <script>
            alert("Photo uploaded successfully.");
            window.location = "employer profile.php?id=<?php echo urlencode($id);?>";
        </script>
        
        <?php
     
        
    } else {
        ?>
        <script>
            alert("Error uploading profile.");
            
        </script>
        <?php
        
    }

    
    
}
?>


</div>
<br/><br/><br/><br/>
</div>

<footer>
        <nav>
            <ul>
                <li><a href="employer about us.php">About Us</a></li>
                <li><a href="employer contact us.php">Contact Us</a></li>
            </ul>
        </nav>
    </footer>

<script>
    function userconfirmation()
        {
            answer = confirm("Do you want to log out?");
            return answer;
        }
</script>

    </body>


    
</html>