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
    <link rel="stylesheet" href="Apost.css">
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
                    <li><a href="Apost.php" id="now">Post</a></li>
                    <li><a href="Apackage.php">Package</a></li>
                    <li><a href="Asale.php">Sale</a></li>
                    <li><a href="Aprofile.php">Profile</a></li>
                </ul>
            </nav>
        </aside>
        <main>
            <?php
                $result = mysqli_query($connect,"SELECT count(*) AS total_post FROM post");
                if($result)
                {
                    $row = mysqli_fetch_assoc($result);
                    $total_post = $row["total_post"];
                }
            ?>
            <div class="amount">
                <h1>
                    <?php echo $total_post?>
                </h1>
            </div>
            <h1>Post</h1>


            <?php
                $result = mysqli_query($connect, "SELECT * FROM post");
                while($row = mysqli_fetch_assoc($result))
                {
                    $job_title = $row["job_name"];
                    $post_id = $row["post_id"];
                    $employer_id = $row["poster_id"];
                    $description = $row["description"];
                    $employer_name = $row["company_name"];
                    $logo_url = $row["logo"];
                    $category = $row["category"];
                    $location = $row["location"];
                    $employment_type = $row["employment_type"];
                    $salary = $row["salary"];
                    $posted_time = $row["created_at"];
                ?>
                <div class="Acontainer">
                    <div class="Aheader">
                        <div class="JobTitle">
                            <h1>
                            <?php
                                echo $job_title;
                            ?>
                            </h1>
                        </div>
                        <div>
                            <img src="/Final-Year-Project-/uploads/jay.jpg">
                            <h2>
                            <?php
                                echo $employer_name;
                            ?>
                            </h2>
                        </div>
                    </div>
                    <div class="Bcontainer">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="Atd">Category</td>
                                    <td class="Btd"></td>
                                    <td><?php echo $category; ?></td>
                                </tr>
                                <tr>
                                    <td class="Atd">Location</td>
                                    <td class="Btd"></td>
                                    <td><?php echo $location; ?></td>
                                </tr>         
                                <tr>
                                    <td class="Atd">Employment Type</td>
                                    <td class="Btd"></td>
                                    <td><?php echo $employment_type; ?></td>
                                </tr>
                                <tr>
                                    <td class="Atd">Description</td>
                                    <td class="Btd"></td>
                                    <td><?php echo $description; ?></td>
                                </tr>
                                <tr>
                                    <td class="Atd">Salary Range</td>
                                    <td class="Btd"></td>
                                    <td><?php echo $salary; ?></td>
                                </tr>
                            </tbody>
                        </table>           
                    </div>
                    <div class="Afooter">
                        <div class="ID">
                            <h2>Post ID : <?php echo $employer_id; ?></h2>
                        </div>
                        <div class="PostTime">
                            <h2>Posted Time : <?php echo $posted_time; ?></h2>
                        </div>
                    </div>
                </div>

                <?php

                }//end while
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
</SCript>
