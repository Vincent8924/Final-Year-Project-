<?php 
    include("../Admin/Adataconnection.php");
    include("../Admin/Asession.php");
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
                    <li><a href="Adashboard.php">Dashboard</a></li>
                    <li><a href="Aseekermanagement.php" id="now">Seeker</a></li>
                    <li><a href="Acompanymanagement.php">Companies</a></li>
                    <li><a href="Aadminmanagement.php">Admin</a></li>
                    <li><a href="Apost.php">Post</a></li>
                    <li><a href="Apackage.php">Package</a></li>
                    <li><a href="Asell.php">Sell</a></li>
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
            <div class="amount">
                <h1>
                    <?php echo $total_seeker?>
                </h1>
            </div>
            <h1>Job Seeker</h1>
            
            <div class="Acontainer">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID</th>
                            <th>Frist Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $result = mysqli_query($connect, "SELECT * FROM jobseeker;");
                            $i = 1;
                            while($row = mysqli_fetch_assoc($result))
                            {
                                
                                
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["jobseeker_id"] ?></td>
                            <td><?php echo $row["jobseeker_firstname"] ?></td>
                            <td><?php echo $row["jobseeker_lastname"] ?></td>
                            <td><?php echo $row["jobseeker_email"] ?></td>
                            <td>
                                <form method="POST" onsubmit="return confirmdelete(<?php echo $row['jobseeker_id']; ?>)" class="delete">
                                   <button type="submit" name="delete" value="<?php echo $row['jobseeker_id']; ?>" >Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                                if (isset($_POST['delete'])) 
                                {
                                    $delete = $_POST['delete'];
                                    mysqli_query($connect, "DELETE FROM jobseeker WHERE jobseeker_id = '$delete'");
                        ?>
                            
                        <script>
                                alert("The job seeker has been deleted!");
                                window.location.href = "Aseekermanagement.php";
                        </script>
                        <?php
                                }
                            $i++;
                            }
                        ?>
                    </tbody>
                </table>
                
            </div>
            <button onclick="display()" class="addbtn">Add Seeker</button>
            <div id="addseeker">
                <form action="" method="POST">
                    <div class="aform">
                        <div class="x" >
                            <button type="button" onclick="closeFrom()" id="x">x</button>
                        </div>
                        <h2>ADD SEEKER</h2>
                        
                        <br>
                        <div class="bform">
                            <div class="label">
                                <label for="admin_fname">Seeker's first name </label>
                            </div>
                            <input type="text" placeholder="First Name" name="fname" required><br>
                        </div>
                        <div class="bform">
                            <div class="label">
                                <label for="admin_lname">Seeker's last name </label>
                            </div>
                            <input type="text" placeholder="Last Name" name="lname" required><br>
                        </div>
                        <div class="bform">
                            <div class="label">
                                <label for="admin_email">Seeker's Email </label>
                            </div>
                            <input type="email" placeholder="Email" name="email" required><br>
                        </div>
                        <div class="bform">
                            <div class="label">
                                <label for="admin_password">Seeker's password </label>
                            </div>
                            <input type="password" placeholder="Password" name="password" required id="password" oninput="checkPasswordLength()"><br>
                        </div>
                        <div class="bform">
                            <div class="label">
                                <label for="confirm_password">Confirm password </label>
                            </div>
                            <input type="password" placeholder="Confirm password" name="confirm_password" id="confirm_password" required oninput="checkPasswordMatch()"><br>
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
                            $resuslt=mysqli_query($connect,"INSERT INTO jobseeker(jobseeker_firstname, jobseeker_lastname, jobseeker_email, jobseeker_password) VALUES ('$fname','$lname','$email','$hashpassword')");
                            ?>
                            <script>
                                alert("Admin has been successfully added!");
                                window.location.href = "Aseekermanagement.php";
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
    function display()
    {
        var div = document.getElementById("addseeker");
        div.style.display = "block";  
    }
    function closeFrom()
    {
        var div = document.getElementById("addseeker");
        div.style.display = "none";  
    }
    function checkPasswordMatch() 
    {
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
    function checkPasswordLength() 
    {
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
        var confirmed = confirm("Are you sure you want to delete company/employer with ID " + id + "?");

        if(confirmed){
            return true;
        }
        else{
            return false;
            history.go(-1);
        }
    }
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
</script>
