<?php 
    include("vdataconnection.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management</title>
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
            <?php
                $result = mysqli_query($connect,"SELECT count(*) AS total_admin FROM admin");
                if($result)
                {
                    $row = mysqli_fetch_assoc($result);
                    $total_admin = $row["total_admin"];
                }
            ?>
            <div class="amount">
                <h1>
                    <?php echo $total_admin?>
                </h1>
            </div>
            <h1>Admin</h1>
            <div class="Acontainer">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody >
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
                                <td>
                                    <form method="POST" onsubmit="return confirmdelete(<?php echo $row['admin_id']; ?>)" class="delete">
                                        <button type="submit" name="delete" value="<?php echo $row['admin_id']; ?>" >Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                                if (isset($_POST['delete'])) 
                                {
                                    $delete = $_POST['delete'];
                                    mysqli_query($connect, "DELETE FROM admin WHERE admin_id = '$delete'");
                                ?>
                                
                                <script>
                                    alert("The admin has been deleted!");
                                    window.location.href = "Aadminmanagement.php";
                                </script>
                        <?php
                                }
                            }
                        ?>
                        
                    </tbody>
                    
                    
                    
                </table>
            </div>
            <button onclick="display()" class="addbtn">Add Admin</button>

            <div id="addadmin">
                <form action="" method="POST">
                    <div class="aform">
                        <div class="x" >
                            <button type="button" onclick="closeFrom()" id="x">x</button>
                        </div>
                        <h2>ADD ADMIN</h2>
                        
                        <br>
                        <div class="bform">
                            <div class="label">
                                <label for="admin_fname">Admin's first name </label>
                            </div>
                            <input type="text" placeholder="  First Name" name="fname" required><br>
                        </div>
                        <div class="bform">
                            <div class="label">
                                <label for="admin_lname">Admin's last name </label>
                            </div>
                            <input type="text" placeholder="  Last Name" name="lname" required><br>
                        </div>
                        <div class="bform">
                            <div class="label">
                                <label for="admin_email">Admin's Email </label>
                            </div>
                            <input type="email" placeholder="  Email" name="email" required><br>
                        </div>
                        <div class="bform">
                            <div class="label">
                                <label for="admin_password">Admin's password </label>
                            </div>
                            <input type="password" placeholder="  Password" name="password" required id="password" oninput="checkPasswordLength()"><br>
                        </div>
                        <div class="bform">
                            <div class="label">
                                <label for="confirm_password">Confirm password </label>
                            </div>
                            <input type="password" placeholder="  Confirm password" name="confirm_password" id="confirm_password" required oninput="checkPasswordMatch()"><br>
                        </div>
                        <br>
                        <div class="alert">
                            <p id="password-length-message"></p>
                            <p id="password-confirm-message" ></p>
                        </div>
                        <br>
                        <input type="submit" value="Submit" class="formbtn" name="Submit">
                    
                    </div>
 
                </form>
                <?php
                    if(isset($_POST['Submit']))
                    {
                        $fname = $_POST['fname'];
                        $lname = $_POST['lname'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $hashpassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
                        $confirm_password = $_POST['confirm_password'];

                        if (strlen($password) < 8)
                        {
                            ?>
                            <script>
                                alert("Unsucessful! The length for password must be at least 8 characters.");
                                history.go(-1);
                            </script>
                            <?php
                        }
                        else if($password !== $confirm_password)
                        {
                            ?>
                            <script>
                                alert("Unsucessful! The password doesn't match.");
                                history.go(-1);
                            </script>
                            <?php
                        }
                        else if($result)
                        {
                            $resuslt=mysqli_query($connect,"INSERT INTO admin(admin_fname, admin_lname, admin_email, admin_password) VALUES ('$fname','$lname','$email','$hashpassword')");
                            ?>
                            <script>
                                alert("Admin has been successfully added!");
                                window.location.href = "Aadminmanagement.php";
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

<script>
    function display(){
        var div = document.getElementById("addadmin");
        div.style.display = "block";  
    }
    function closeFrom(){
        var div = document.getElementById("addadmin");
        div.style.display = "none";  
    }
    function checkPasswordMatch() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm_password").value;
        var message = document.getElementById("password-confirm-message");

        if (password !== confirmPassword) {
            message.textContent = "Passwords do not match!";
        }
        else {
            message.textContent = "";
        }
    }
    function checkPasswordLength() {
        var password = document.getElementById("password").value;
        var message = document.getElementById("password-length-message");
        if (password.length < 8) {
            message.textContent = "Password must be at least 8 characters long!";
        }
        else {
            message.textContent = "";
        }
    }
    function confirmdelete(id)
    {
        var confirmed = confirm("Are you sure you want to delete admin with ID " + id + "?");

        if(confirmed){
            return true;
        }
        else{
            return false;
            history.go(-1);
        }
    }
</script>


