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
        <h1>JobHelper</h1>
        <div>
            <a class="AdminAcc" onclick="displaybar()">
                <?php
                    $id = $_SESSION['id'];

                    $result = mysqli_query($connect,"SELECT * FROM admin where admin_id='$id'");
                    if($result)
                    {
                        $row = mysqli_fetch_assoc($result);
                        $fname = $row["admin_fname"];
                    }
                ?>
                <?php echo"$fname"; ?>            
            </a>
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
