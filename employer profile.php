<!-- 
    以后这里最上面等login做完了这里就可以直接接收账号然后下面就可以以email为pk去显示profile的照片还是文本内容之类的
-->
<?php include('database_connection.php'); 



?>

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
        $name = "profile_photo";


        //下面这段以后要调整的等login好就要调成跟着当前的email之类的
        $result = mysqli_query($connect, "SELECT * FROM employer_profile where employer_email = '$email' and photo_name = '$name'");	
        if ($result) {
        while($data = mysqli_fetch_assoc($result))
        {
    ?>

    <div id="profile_photo_space" >
    
    <img id="profile_photo" src="data:image/png;base64,<?php echo base64_encode($data['photo_data']); ?>" alt="Photo">
    </div>
    <?php



            }
        }

    ?>

    <br/><br/><br/>
    <div class="mid">
    <form  method="post" enctype="multipart/form-data">
    <input type="file" name="photo" accept="image/*">

    <button type="submit" name="submit">Upload Photo</button>

    </form></div>

    <br/><br/>

    <div class="profile">
    Employer/Company name 
    <br/><br/>
    <input type="text" name="name">
    </div>

    <br/><br/>

    <div class="profile">
    Website 
    <br/><br/>
    <input type="text" name="website">
    </div>

    <br/><br/>

    <div class="profile">
    industry
    <br/><br/>
    <input type="text" name="industry">
    </div>

    <br/><br/>

    <div class="profile">
    Company Size
    <br/><br/>
    <input type="text" name="size">
    </div>

    <br/><br/>

    <div class="profile">
    Primary location
    <br/><br/>
    <input type="text" name="location">
    </div>

    <br/><br/>

    <div class="profile">
    Description
    <br/><br/>
    <input type="text" name="description">
    </div>









<?php

if(isset($_POST['submit'])) {
    // 获取上传的文件信息
    $fileName = "profile_photo";
    $fileTmpName = $_FILES['photo']['tmp_name'];


    // 读取文件数据
    $fileData = file_get_contents($fileTmpName);
    $email = $_REQUEST["email"];
    // 将文件数据插入到数据库
    mysqli_query($connect, "DELETE FROM employer_profile WHERE employer_email = '$email'");



    $stmt = mysqli_prepare($connect, "INSERT INTO employer_profile (employer_email,photo_name, photo_data) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $email, $fileName, $fileData);

    //header("Location:employer profile.php?upload&email=" . urlencode($email));
    //at first I plan to put this to let user after change the profile photo can achieve the same effect with refresh web page
    //but does not work


    if(mysqli_stmt_execute($stmt)) {
        ?>
        <script>
            alert("Photo uploaded successfully.Please refresh this page.");
            
        </script>
        
        <?php
        
    } else {
        ?>
        <script>
            alert("Error uploading photo.Please make sure your photo is below 100kb.");
            
        </script>
        <?php
        
    }

    
    
}
?>


</div>
<br/><br/><br/><br/>
    </body>


    
</html>