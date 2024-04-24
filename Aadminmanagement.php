<?php 
    include("dataconnection.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seeker Management</title>
    <link rel="stylesheet" href="Aadminmanagement.css">
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
                    <li><a href="Adashboard.php" >Dashboard</a></li>
                    <li><a href="Aseekermanagement.php">Seeker</a></li>
                    <li><a href="Acompanymanagement.php">Companies</a></li>
                    <li><a href="Aadminmanagement.php" id="now">Admin</a></li>
                    <li><a href="Apost.php">Post</a></li>
                    <li><a href="Aprofile.php">Profile</a></li>
                </ul>
            </nav>
        </aside>
        <main>
            <h1>Admin</h1>
            <div class="Acontainer">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $result = mysqli_query($connect, "SELECT * FROM admin;");
                            $count = mysqli_num_rows($result);
                            while($row = mysqli_fetch_assoc($result))
                            {
                        ?>
                        <tr>
                            <td><?php echo $row["admin_id"] ?></td>
                            <td><?php echo $row["admin_fname"] ?></td>
                            <td><?php echo $row["admin_lname"] ?></td>
                            <td><?php echo $row["admin_email"] ?></td>
                        </tr>

                        <?php
                            }
                        ?>
                    </tbody>
                    
                </table>
                <button onclick="display()" class="addbtn">Add Admin</button>
            </div>
            <div id="addadmin">
                <form action="" method="POST">
                    <div class="aform">
                        <h2>ADD ADMIN</h2>
                        <div class="bform">
                            <div class="label">
                                <label for="admin_fname">Admin's first name </label>
                            </div>
                            <input type="text" placeholder="  First Name" name="admin_fname" required><br>
                        </div>
                        <div class="bform">
                            <div class="label">
                                <label for="admin_lname">Admin's last name </label>
                            </div>
                            <input type="text" placeholder="  Last Name" name="admin_lname" required><br>
                        </div>
                        <div class="bform">
                            <div class="label">
                                <label for="admin_email">Admin's Email </label>
                            </div>
                            <input type="email" placeholder="  Email" name="admin_email" required><br>
                        </div>
                        <div class="bform">
                            <div class="label">
                                <label for="admin_password">Admin's password </label>
                            </div>
                            <input type="password" placeholder="  Password" name="admin_password" required><br>
                        </div>
                        <div class="bform">
                            <div class="label">
                                <label for="confirm_password">Confirm password </label>
                            </div>
                            <input type="password" placeholder="  Confirm password" name="confirm_password" required><br>
                        </div>

                        <input type="submit" value="Submit" class="formbtn" name="Submit">
                    
                    </div>
 
                </form>
                <?php
                    if(isset($_POST['Submit']))
                    {
                        $fname = $_POST['admin_fname'];
                        $lname = $_POST['admin_lname'];
                        $email = $_POST['admin_email'];
                        $password = $_POST['admin_password'];
                    

                        if (strlen($_POST['admin_password']) < 8) {
                            ?>
                            <script>
                                alert("Password must be at least 8 characters long! Please Try again");
                                history.go(-1);
                            </script>
                            <?php
                            }
                            else if($result)
                            {
                            
                            $resuslt=mysqli_query($connect,"INSERT INTO admin(admin_fname, admin_lname, admin_email, admin_password) VALUES ('$fname','$lname','$email','$password')");
                
                            ?>
                            <script type="text/javascript">
                                alert("Admin has been successfully added!");
                                history.go(1);
                            </script>
                            <?php
                            }
                        }
                ?>
            </div>
            
        </main>
    </div>
    <footer>
        <p>JobHelper&trade;</p>
    </footer>

</body>
</html>

<script>//display add admin form
    function display(){
        var div = document.getElementById("addadmin");
        if(div.style.display !== "block")
        {
            div.style.display = "block";  
        }
        else
        {
            div.style.display = "none";  
        }
    }
</script>


