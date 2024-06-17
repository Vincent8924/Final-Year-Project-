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
    <link rel="stylesheet" href="Adashboard.css">
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
            <a href="Aprofile.php" >Profile</a>
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
                    <li><a href="Adashboard.php" id="now">Dashboard</a></li>
                    <li><a href="Aseekermanagement.php">Seeker</a></li>
                    <li><a href="Acompanymanagement.php">Companies</a></li>
                    <li><a href="Aadminmanagement.php">Admin</a></li>
                    <li><a href="Apost.php">Post</a></li>
                    <li><a href="Apackage.php">Package</a></li>
                    <li><a href="Asale.php">Sale</a></li>
                    <li><a href="Aprofile.php">Profile</a></li>
                </ul>
            </nav>
        </aside>

        <main>
        <?php
            $result = mysqli_query($connect,"SELECT count(*) AS total_seeker FROM jobseeker");
            if($result)
            {
                $row = mysqli_fetch_assoc($result);
                $total_seeker = $row["total_seeker"];
            }
        ?>
        <?php
            $result = mysqli_query($connect,"SELECT count(*) AS total_employer FROM employer");
            if($result)
            {
                $row = mysqli_fetch_assoc($result);
                $total_employer = $row["total_employer"];
            }
        ?>
        <?php
        $result = mysqli_query($connect,"SELECT count(*) AS total_admin FROM admin");
        if($result)
        {
            $row = mysqli_fetch_assoc($result);
            $total_admin = $row["total_admin"];
        }
        ?>
            <div class="Acontainer">
                <div class="Aheader">
                    <div>
                        <h3>User</h3>
                    </div>
                    <div class="amount">
                        <h3>
                            <?php echo $total_seeker+$total_admin+$total_employer?>
                        </h3>
                    </div>
                </div>
                <div class="Bcontainer">
                    <div class="Ccontainer">
                            <h4>Seeker</h4>
                            <h5>
                                <?php echo $total_seeker?>
                            </h5>
                    </div>
                    <div class="Ccontainer">
                        <h4>Companies</h4>
                        <h5>
                            <?php echo $total_employer?>
                        </h5>
                    </div>
                    <div class="Ccontainer">
                        <h4>Admin</h4>
                        <h5>
                            <?php echo $total_admin?>
                        </h5>
                    </div>
                </div>
            </div>
            <!--post--->
            <?php
                $result = mysqli_query($connect,"SELECT count(*) AS total_post FROM post");
                if($result)
                {
                    $row = mysqli_fetch_assoc($result);
                    $total_post = $row["total_post"];
                }
            ?>
            <div class="Apost">
                <div class="postheader">
                    <div>
                        <h3>Post</h3>
                    </div>
                    <div class="amount">
                        <h3>
                            <?php
                                echo $total_post
                            ?>
                        </h3>
                    </div>
                </div>
                <div class="Bpost">
                    <table>
                        <thead>
                            <tr>
                                <th class="category">Job Category</th> 
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $result = mysqli_query($connect, "SELECT category, COUNT(*) as num FROM post GROUP BY category");
                                while($row = mysqli_fetch_assoc($result))
                                {
                            ?>
                                <tr>
                                    <td class="category"><?php echo $row["category"] ?></td>
                                    <td><?php echo $row["num"] ?></td>
                                </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>

            <!--application-->
            <?php
                $result = mysqli_query($connect,"SELECT count(*) AS total_apply FROM applications");
                if($result)
                {
                    $row = mysqli_fetch_assoc($result);
                    $total_apply = $row["total_apply"];
                }
            ?>
            <div class="Apost">
                <div class="postheader">
                    <div>
                        <h3>Application</h3>
                    </div>
                    <div class="amount">
                        <h3>
                            <?php
                                echo $total_apply
                            ?>
                        </h3>
                    </div>
                </div>

                <div class="Bpost">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th> 
                                <th>Job Seeker's ID</th>
                                <th>Employer's ID</th>
                                <th>Post's ID</th>
                                <th>Status</th>

                                <?php
                                    /*
                                    <th>No.</th> 
                                    <th>Job Seeker's ID</th>
                                    <th>Job Seeker's Name</th>
                                    <th>Employer's ID</th>
                                    <th>Employer's Name</th>
                                    <th>Post's ID</th>
                                    <th>Post's Name</th>
                                    <th>Status</th>
                                    */
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                $i=1;   
                                $result = mysqli_query($connect, "SELECT * FROM applications");
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    $Sid = $row["jobseeker_id"];
                                    $Eid = $row["poster_id"];
                                    $postid = $row["post_id"];
                                    $status = $row["status"];

                                    if(isset($Sid))
                                    {
                                        $sresult = mysqli_query($connect, "SELECT * FROM jobseeker where jobseeker_id=$Sid;");
                                        $srow = mysqli_fetch_assoc($sresult);
                                        $Sname= $srow["jobseeker_firstname"];
                                    }

                                    if(isset($Eid))
                                    {
                                        $eresult = mysqli_query($connect, "SELECT * FROM employer where id=$Eid;");
                                        $erow = mysqli_fetch_assoc($eresult);
                                        $Ename= $erow["employer_name"];
                                    }

                                    if(isset($postid))
                                    {
                                        $presult = mysqli_query($connect, "SELECT * FROM post where post_id=$postid;");
                                        $prow = mysqli_fetch_assoc($presult);
                                        $postname= $prow["job_name"];
                                    }
                            ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $Sname ?></td>
                                    <td><?php echo $Ename ?></td>
                                    <td><?php echo $postname ?></td>
                                    <td><?php echo $status ?></td>

                                    <?php
                                    /*
                                    <td><?php echo $i ?></td>   
                                    <td><?php echo $Sid ?></td>
                                    <td><?php echo $Sname ?></td>
                                    <td><?php echo $Eid ?></td>
                                    <td><?php echo $Ename ?></td>
                                    <td><?php echo $postid ?></td>
                                    <td><?php echo $postname ?></td>
                                    <td><?php echo $status ?></td>
                                    */
                                    ?>
                                </tr>
                            <?php

                                    $i++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>


            <!--sale-->
            <?php
                $result = mysqli_query($connect,"SELECT SUM(purchase_amount) AS total_sale FROM sale");
                if($result)
                {
                    $row = mysqli_fetch_assoc($result);
                    $total_sale = $row["total_sale"];
                }
            ?>
            <div class="Apost">
                <div class="postheader">
                    <div>
                        <h3>Sale</h3>
                    </div>
                    <div class="amount">
                        <h3>
                            RM 
                            <?php
                                echo $total_sale
                            ?>
                        </h3>
                    </div>
                </div>

                <div class="Bpost">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th> 
                                <th>Buyer/Employer's ID</th>
                                <th>Package</th>
                                <th>Sale Amount</th>

                                <?php

                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=1;   
                                $result = mysqli_query($connect, "SELECT * FROM sale");
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    $packageid = $row["package_id"];
                                    if(isset($packageid))
                                    {
                                        $sresult = mysqli_query($connect, "SELECT * FROM package WHERE package_id = $packageid");
                                        $srow = mysqli_fetch_assoc($sresult);
                                        $packagename= $srow["package_name"];
                                    }
                            ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $row["employer_id"] ?></td>
                                    <td><?php echo $packagename     ?></td>
                                    <td><?php echo $row["purchase_amount"] ?></td>
                                </tr>
                            <?php

                                    $i++;
                                }
                            ?>
                        </tbody>
                    </table>
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
</SCript>
