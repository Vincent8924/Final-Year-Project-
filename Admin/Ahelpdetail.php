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
    <link rel="stylesheet" href="Ahelpdetail.css">
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
                    <li><a href="Adashboard.php" >Dashboard</a></li>
                    <li><a href="Aseekermanagement.php">Seeker</a></li>
                    <li><a href="Acompanymanagement.php">Companies</a></li>
                    <li><a href="Aadminmanagement.php">Admin</a></li>
                    <li><a href="Apost.php">Post</a></li>
                    <li><a href="Apackage.php">Package</a></li>
                    <li><a href="Asale.php">Sale</a></li>
                    <li><a href="Ahelp.php" id="now">Help&Feedback</a></li>
                    <li><a href="Aprofile.php">Profile</a></li>
                </ul>
            </nav>
        </aside>
        <main>
            <a href="Ahelp.php" class="back"><h2>< Back</h2></a>

            <?php 
                $id=$_REQUEST['cid'];
                
                $result = mysqli_query($connect, "SELECT * FROM contact WHERE contact_id=$id;");
                $row = mysqli_fetch_assoc($result);
                if($row)
                {
                    $cid = $row["contact_id"];
                    $cname = $row["name"];
                    $cemail = $row["email"];
                    $csubject = $row["subject"];
                    $cmessage = $row["message"];
                    $cstatus = $row["status"];
                    $ctime = $row["request_time"];
                                    
                    if($cstatus==0)
                    {
                        $cstatus = "Unresolved Feedback";
                    }
                    else
                    {
                        $cstatus = "Resolved Feedback";
                    }
            ?>
                    <div class="Acontainer">
                        <div class="Aheader">
                            <div>
                                <h3> <?php echo $csubject; ?></h3>
                            </div>
                            <div>
                                <h3> <?php echo $ctime; ?></h3>
                            </div>
                        </div>
                        <div class="Bcontainer">
                            <div class="Ccontainer">
                                <table>
                                    <h2 class="title">Details</h2>
                                    <tbody> 
                                        <tr>
                                            <td class="td1"></td>
                                            <td class="Atd">Feedback ID</td>
                                            <td class="td2">
                                            <td class="td3">
                                            <td class="valuetd"><?php echo $cid; ?></td>
                                            <td class="td4"></td>
                                        </tr>
                                        <tr>
                                            <td class="td1"></td>
                                            <td class="Atd">User Name</td>
                                            <td class="td2">
                                            <td class="td3">
                                            <td class="valuetd"><?php echo $cname; ?></td>
                                            <td class="td4"></td>
                                        </tr>
                                        <tr>
                                            <td class="td1"></td>
                                            <td class="Atd">User Email</td>
                                            <td class="td2">
                                            <td class="td3">
                                            <td class="valuetd"><?php echo $cemail; ?></td>
                                            <td class="td4"></td>
                                        </tr>
                                        <tr>
                                            <td class="td1"></td>
                                            <td class="Atd">Time</td>
                                            <td class="td2">
                                            <td class="td3">
                                            <td class="valuetd"><?php echo $ctime; ?></td>
                                            <td class="td4"></td>
                                        </tr>
                                        <tr>
                                            <td class="td1"></td>
                                            <td class="Atd">Status</td>
                                            <td class="td2">
                                            <td class="td3">
                                            <td class="valuetd"><?php echo $cstatus; ?></td>
                                            <td class="td4">
                                                <button type="submit" name="editStatus" onclick="editStatus()"class="edit"><i class="fas fa-edit"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="Ccontainer">
                                <table>
                                    <h2 class="title">Help & Feedback</h2>
                                    <tbody> 
                                        <tr>
                                            <td class="td1"></td>
                                            <td class="Atd">Subject</td>
                                            <td class="td2">
                                            <td class="td3">
                                            <td class="valuetd"><?php echo $csubject; ?></td>
                                            <td class="td4"></td>
                                        </tr>
                                        <tr>
                                            <td class="td1"></td>
                                            <td class="Atd">Message</td>
                                            <td class="td2">
                                            <td class="td3">
                                            <td class="valuetd"><?php echo $cmessage; ?></td>
                                            <td class="td4"></td>   
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                    </div>

            <?php

                }
            ?>

            <div id="editStatus">
                <form method="POST">
                    <div class="aform">
                        <div class="x" >
                            <button type="button" onclick="closeeditStatus()" id="x">x</button>
                        </div>
                        
                        <h2>Edit Status</h2>
                        <br>
                        <div class="bform">
                            <div class="labelleft"></div>
                            <div class="label">
                                <label >Status </label>
                            </div>
                            <select name="status" required>
                                <option value="0" selected>Unresolved Feedback</option> 
                                <option value="1">Resolved Feedback</option> 
                            </select>
                            <div class="selectrigth"></div>
                        </div>
                        <br>
                        <input type="submit" value="Edit" class="formbtn" name="editStatus">   
                    </div>
                </form>
            </div>
            <?php
                if(isset($_POST['editStatus']))
                {
                    $status = $_POST['status'];
                    $result=mysqli_query($connect,"UPDATE contact SET status = '$status' where contact_id = '$id'");
                    if($result)
                    {
                        ?>
                        <script>
                            alert("The status have been updated!");
                            window.location.href = "Ahelp.php";
                        </script>
                        <?php
                    }
                }
            ?>
        </main>
    </div>

    <footer>
        <p>JobHelper&trade;</p>
    </footer>

</body>
</html>

<SCript>
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
    function editStatus(){
        var div = document.getElementById("editStatus");
        div.style.display = "block";  
    }
    function closeeditStatus(){
        var div = document.getElementById("editStatus");
        div.style.display = "none";  
    }
</SCript>
