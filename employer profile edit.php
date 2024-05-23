<?php include('vdataconnection.php'); ?>
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
    <?php
   
        $id = $_REQUEST["id"];
        


        
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
    $email = $_REQUEST["email"];
    
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
    </body>


    
</html>