<?php 
    include("vdataconnection.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seeker Management</title>
    <link rel="stylesheet" href="Aseekermanagement.css">
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
                <ul>`
                    <li><a href="Adashboard.php" >Dashboard</a></li>
                    <li><a href="Aseekermanagement.php" id="now">Seeker</a></li>
                    <li><a href="Acompanymanagement.php">Companies</a></li>
                    <li><a href="Aadminmanagement.php">Admin</a></li>
                    <li><a href="Apost.php">Post</a></li>
                    <li><a href="Aprofile.php">Profile</a></li>
                </ul>
            </nav>
        </aside>
        <main>
            <h1>Job Seeker</h1>
            <div class="Acontainer">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $result = mysqli_query($connect, "SELECT * FROM jobseeker;");
                            $count = mysqli_num_rows($result);
                            $i = 1;
                            while($row = mysqli_fetch_assoc($result))
                            {
                                
                                
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["jobseeker_id"] ?></td>
                            <td><?php echo $row["jobseeker_name"] ?></td>
                            <td><?php echo $row["jobseeker_email"] ?></td>
                        </tr>

                        <?php
                                $i++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <footer>
        <p>JobHelper&trade;</p>
    </footer>

</body>
</html>
