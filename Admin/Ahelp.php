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
    <link rel="stylesheet" href="Ahelp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header class="header">
        <img src="../general_image/jobhelper_logo.png" class="logo">
        <div>
            <button class="AdminAcc" onclick="displaybar()">
                <?php
                    $id = $_SESSION['adminid'];;

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
            <a href="Aprofile.php">Profile</a>
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
                    <li><a href="Ahelp.php" id="now">Help&Feedback</a></li>
                    <li><a href="Aprofile.php">Profile</a></li>
                </ul>
            </nav>
        </aside>
        <main>
        <h1>Help&Feedback</h1>
        <!--Unresolved-->
        <div class="Acontainer">
            <?php
                $result = mysqli_query($connect,"SELECT count(*) AS total_unresolved_feedback FROM contact WHERE  status = 0");
                if($result)
                {
                    $row = mysqli_fetch_assoc($result);
                    $total_unresolved_feedback = $row["total_unresolved_feedback"];

                }
            ?>
            <div class="Aheader">
                <div>
                    <h3>Unresolved Feedback</h3>
                </div>
                <div class="amount">
                    <h3>
                        <?php
                            echo $total_unresolved_feedback;
                        ?>
                    </h3>
                </div>
            </div>
            
            <div class="Bcontainer">
                <?php
                
                ?>
                <div class="Ccontainer">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>Subject</th>
                                <th>Require Time</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                                $result = mysqli_query($connect, "SELECT * FROM contact WHERE status = 0");
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    $cid = $row["contact_id"];
                                    $cname = $row["name"];
                                    $cemail = $row["email"];
                                    $csubject = $row["subject"];
                                    $cmessage = $row["message"];
                                    $cstatus = $row["status"];
                                    $ctime = $row["request_time"];
                                    
                                    if($cstatus==1)
                                    {
                                        $package_sale_status = "Unresolved Feedback";
                                    }
                                    else
                                    {
                                        $package_sale_status = "Resolved Feedback";
                                    }
                            ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $cname ?></td>
                                        <td><?php echo $cemail ?></td>
                                        <td><?php echo $csubject ?></td>
                                        <td><?php echo $ctime ?></td>
                                        <td class="view">
                                            <button type="button" onclick="view(<?php echo $cid; ?>)">View</button>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>

        </div>
        <!--Resolved-->
        <div class="Acontainer">
            <?php
                $result = mysqli_query($connect,"SELECT count(*) AS total_resolved_feedback FROM contact WHERE  status = 1");
                if($result)
                {
                    $row = mysqli_fetch_assoc($result);
                    $total_resolved_feedback = $row["total_resolved_feedback"];

                }
            ?>
            <div class="Aheader">
                <div>
                    <h3>Resolved Feedback</h3>
                </div>
                <div class="amount">
                    <h3>
                        <?php
                            echo $total_resolved_feedback;
                        ?>
                    </h3>
                </div>
            </div>
            
            <div class="Bcontainer">
                <?php
                
                ?>
                <div class="Ccontainer">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>Subject</th>
                                <th>Require Time</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                                $result = mysqli_query($connect, "SELECT * FROM contact WHERE status = 1");
                                while($row = mysqli_fetch_assoc($result))
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
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $cname ?></td>
                                        <td><?php echo $cemail ?></td>
                                        <td><?php echo $csubject ?></td>
                                        <td><?php echo $ctime ?></td>
                                        <td class="view">
                                            <button type="button" onclick="view(<?php echo $cid; ?>)">View</button>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>

        </div>
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
    function view(id)
    {
        window.location = "Ahelpdetail.php?cid="+id;
    }
</SCript>
