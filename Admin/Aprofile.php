<?php 
    include("../Admin/Adataconnection.php");
    include("../Admin/Asession.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Aprofile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <header class="header">
        <img src="../general_image/jobhelper_logo.png" class="logo">
        <div>
            <button class="AdminAcc" onclick="displaybar()">
                <?php
                    $id = $_SESSION['id'];

                    $result = mysqli_query($connect,"SELECT * FROM admin where admin_id='$id'");
                    if($result)
                    {
                        $row = mysqli_fetch_assoc($result);
                        $fname = $row["admin_fname"];
                    }
                ?>
                <i class="fa-solid fa-user"></i><?php echo"   $fname"; ?>            
            </button>
        </div>
    </header>
    
    <div class="aAccBar" id="aAccBar">
        <div class="bAccBar">
            <form >
                <input type="button" name="profile" value="Profile" onclick="goProfile()">
            </form>
        </div>
        <div class="bAccBar">
            <form action="" method="POST" id="logout">
                <input type="submit" name="logout" value="Log-Out">
            </form> 
        </div>
    </div>
    <?php
        if(isset($_POST['logout']))
        {
            session_destroy();
            echo'<script>alert("Log-Out successful!");window.location.href="Alogin.php";</script>';
        }
    ?>
    <div class="container">
        <aside>
            <nav class="Menu">
                <ul>
                    <li><a href="Adashboard.php">Dashboard</a></li>
                    <li><a href="Aseekermanagement.php">Seeker</a></li>
                    <li><a href="Acompanymanagement.php">Companies</a></li>
                    <li><a href="Aadminmanagement.php">Admin</a></li>
                    <li><a href="Apost.php">Post</a></li>
                    <li><a href="Apackage.php">Package</a></li>
                    <li><a href="Asale.php">Sale</a></li>
                    <li><a href="Ahelp.php">Help&Feedback</a></li>
                    <li><a href="Aprofile.php" id="now">Profile</a></li>
                </ul>
            </nav>
        </aside>
        <main>
        <h1>Profile</h1>
        <div class="Acontainer">
            <div class="Bcontainer">
                <table>
                    <tbody>
                        <?php
                            $result = mysqli_query($connect,"SELECT * FROM admin where admin_id='$id'");
                            if($result)
                            {
                                $row = mysqli_fetch_assoc($result);
                                $fname = $row["admin_fname"];
                                $lname = $row["admin_lname"];
                                $email = $row["admin_email"];
                                $lname = $row["admin_lname"];
                            }
                        ?>
                        <tr>
                            <td class="Atd"><i class="fa-solid fa-id-card"></i>  ID</td>
                            <td class="colontd">:</td>
                            <td class="valuetd"><?php echo"$id" ?></td>
                            <td class="btntd"></td>
                        </tr>
                        <tr>
                            <td class="Atd"><i class="fa-regular fa-circle-user"></i>  First Name</td>
                            <td class="colontd">:</td>
                            <td class="valuetd"><?php echo"$fname" ?></td>
                            <td class="btntd">
                                <button onclick="editfname()" class="edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="Atd"><i class="fa-regular fa-circle-user"></i>  Last Name</td>
                            <td class="colontd">:</td>
                            <td class="valuetd"><?php echo"$lname" ?></td>
                            <td class="btntd">
                                <button onclick="editlname()" class="edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="Atd"><i class="fa-solid fa-envelope"></i>  Email</td>
                            <td class="colontd">:</td>
                            <td class="valuetd"><?php echo"$email" ?></td>
                            <td class="btntd">
                                <button onclick="editemail()" class="edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="Atd"><i class="fa-solid fa-lock"></i>  Password</td>
                            <td class="colontd">:</td>
                            <td class="valuetd">********</td>
                            <td class="btntd">
                                <form method="POST">
                                    <button type="submit" name="editPassword" class="edit"><i class="fas fa-edit"></i></button>
                                </form>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
        </main>
    </div>
    

    <div id="editfname">
        <form method="POST">
            <div class="aform">
                <div class="x" >
                    <button type="button" onclick="closeeditfname()" id="x">x</button>
                </div>
                
                <h2>Edit First Name</h2>
                <br>
                <div class="bform">
                    <div class="label">
                        <label >First Name </label>
                    </div>
                        <input type="text" value="<?php echo"$fname"?>" name="fname" required><br>
                </div>
                <br>
                <input type="submit" value="Edit" class="formbtn" name="editfname">   
            </div>
        </form>
    </div>
    <div id="editlname">
        <form method="POST">
            <div class="aform">
                <div class="x" >
                    <button type="button" onclick="closeeditlname()" id="x">x</button>
                </div>
                
                <h2>Edit Last Name</h2>
                <br>
                <div class="bform">
                    <div class="label">
                        <label >Last Name </label>
                    </div>
                        <input type="text" value="<?php echo"$lname"?>" name="lname" required><br>
                </div>
                <br>
                <input type="submit" value="Edit" class="formbtn" name="editlname">   
            </div>
        </form>
    </div>
    <div id="editemail">
        <form method="POST">
            <div class="aform">
                <div class="x" >
                    <button type="button" onclick="closeeditemail()" id="x">x</button>
                </div>
                
                <h2>Edit Email</h2>
                <br>
                <div class="bform">
                    <div class="label">
                        <label >Email </label>
                    </div>
                        <input type="email" value="<?php echo"$email"?>" name="email" required><br>
                </div>
                <br>
                <input type="submit" value="Edit" class="formbtn" name="editemail">   
            </div>
        </form>
    </div>
    
    <?php
        if(isset($_POST['editfname']))
        {
            $fname = $_POST['fname'];
            $result=mysqli_query($connect,"UPDATE admin SET admin_fname = '$fname' where admin_id = '$id'");
            if($result)
            {
                ?>
                <script>
                    alert("Your first name have been edited!");
                    window.location.href = "Aprofile.php";
                </script>
                <?php
            }
        }
        if(isset($_POST['editlname']))
        {
            $lname = $_POST['lname'];
            $resust=mysqli_query($connect,"UPDATE admin SET admin_lname = '$lname' where admin_id = '$id'");
            if($result)
            {
                ?>
                <script>
                    alert("Your last name have been edited!");
                    window.location.href = "Aprofile.php";
                </script>
                <?php
            }
        }
        if(isset($_POST['editemail']))
        {
            $email = $_POST['email'];
            $result=mysqli_query($connect,"UPDATE admin SET admin_email = '$email' where admin_id = '$id'");
            if($result)
            {
                ?>
                <script>
                    alert("Your email have been edited!");
                    window.location.href = "Aprofile.php";
                </script>
                <?php
            }
        }
        if (isset($_POST['editPassword']))  
        {   
            session_start();
            $otp = rand(100000, 999999);

            require "../Mail\phpmailer/PHPMailerAutoload.php";
            $mail = new PHPMailer;
            
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
        
            $mail->Username = getenv('SMTP_USERNAME') ?: 'www.jobhelper@gmail.com';
            $mail->Password = getenv('SMTP_PASSWORD') ?: 'izva godc asun goxa';
        
            $mail->setFrom('www.jobhelper@gmail.com', 'Password Reset');
            $mail->addAddress($email);
        
            $mail->isHTML(true);
            $mail->Subject = "Reset your password";
            $mail->Body = "<p>Dear user, </p><h3>Your verify OTP code is $otp<br></h3>";
        
            if (!$mail->send()) 
            {
                echo "<script>alert('Fail to send OTP, please try again.');</script>";
            } else 
            {
                $_SESSION['otp'] = $otp;
                $_SESSION['email'] = $email;
                echo "<script>alert('OTP has been sent to $email'); window.location.replace('Aoptverify.php');</script>";
            }
        }
        
    
        ?>


    <footer>
        <p>JobHelper&trade;</p>
    </footer>
</body>
</html>

<script>
    function displaybar()
    {
        var div = document.getElementById("aAccBar");
        var divdisplay = window.getComputedStyle(div);

        if(divdisplay.display === "block" )
        {
            div.style.display = "none";  
        }
        else 
        {
            div.style.display = "block"; 
        }
    }
    function editfname(){
        var div = document.getElementById("editfname");
        div.style.display = "block";  
    }
    function closeeditfname(){
        var div = document.getElementById("editfname");
        div.style.display = "none";  
    }
    function editlname(){
        var div = document.getElementById("editlname");
        div.style.display = "block";  
    }
    function closeeditlname(){
        var div = document.getElementById("editlname");
        div.style.display = "none";  
    }
    function editemail(){
        var div = document.getElementById("editemail");
        div.style.display = "block";  
    }
    function closeeditemail(){
        var div = document.getElementById("editemail");
        div.style.display = "none";  
    }
</script>
