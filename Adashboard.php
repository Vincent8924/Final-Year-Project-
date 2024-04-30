<?php 
    include("vdataconnection.php"); 
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
        <div class="header-buttons">
            <a href="#" class="AdminAcc">AdminAcc</a>
        </div>
    </header>

    <div class="container">
        <aside>
            <nav class="Menu">
                <ul>
                    <li><a href="Adashboard.php" id="now">Dashboard</a></li>
                    <li><a href="Aseekermanagement.php">Seeker</a></li>
                    <li><a href="Acompanymanagement.php">Companies</a></li>
                    <li><a href="Aadminmanagement.php">Admin</a></li>
                    <li><a href="Apost.php">Post</a></li>
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
            /*
            $result = mysqli_query($connect,"SELECT count(*) AS total_employer FROM **");
            if($result)
            {
                $row = mysqli_fetch_assoc($result);
                $total_employer = $row["total_employer"];
            }
            */
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
                            <?php echo $total_seeker+$total_admin?>
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
                        amount
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
                /*
                $result = mysqli_query($connect,"SELECT count(*) AS total_post FROM post");
                if($result)
                {
                    $row = mysqli_fetch_assoc($result);
                    $total_post = $row["total_post"];
                }
                */
            ?>
            <div class="Acontainer">
                <div class="Aheader">
                    <div>
                        <h3>Post</h3>
                    </div>
                    <div class="amount">
                        <h3>
                            <?php
                                //echo $total_post
                            ?>
                        </h3>
                    </div>
                </div>
                <div class="Bcontainer">
                    
                </div>
            </div>
        </main>
    </div>

    <footer>
        <p>JobHelper&trade;</p>
    </footer>

</body>
</html>
