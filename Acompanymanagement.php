<?php 
    include("vdataconnection.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campany Management</title>
    <link rel="stylesheet" href="Acompanymanagement.css">
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
                    <li><a href="Acompanymanagement.php" id="now">Companies</a></li>
                    <li><a href="Aadminmanagement.php" >Admin</a></li>
                    <li><a href="Apost.php">Post</a></li>
                    <li><a href="Aprofile.php">Profile</a></li>
                </ul>
            </nav>
        </aside>
        <main>
            <?php
                $result = mysqli_query($connect,"SELECT count(*) AS total_employer FROM employer");
                if($result)
                {
                    $row = mysqli_fetch_assoc($result);
                    $total_employer = $row["total_employer"];
                }
            ?>
            <div class="amount">
                <h1>
                    <?php echo $total_employer?>
                </h1>
            </div>
            <h1>Company/Employer</h1>
            <div class="Acontainer">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Campany Name</th>
                            <th>Email</th>
                            <th>Post balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $result = mysqli_query($connect, "SELECT * FROM employer;");
                            $count = mysqli_num_rows($result);
                            while($row = mysqli_fetch_assoc($result))
                            {
                        ?>
                        <tr>
                            <td><?php echo $row["id"] ?></td>
                            <td><?php echo $row["employer_name"] ?></td>
                            <td><?php echo $row["employer_email"] ?></td>
                            <td><?php echo $row["balance"] ?></td>
                        </tr>

                        <?php
                            }
                        ?>
                    </tbody>
                    
                </table>
                <button onclick="display()" class="addbtn">Add Employer</button>
            </div>
            <div id="addemployer">
                <form action="" method="POST">
                    <div class="aform">
                        <div class="x" >
                            <button type="button" onclick="closeFrom()" id="x">x</button>
                        </div>
                        <h2>ADD ADMIN</h2>
                        
                        <br>
                        <div class="bform">
                            <div class="label">
                                <label >Company's name </label>
                            </div>
                            <input type="text" placeholder="  Name" name="name" required><br>
                        </div>
                        <div class="bform">
                            <div class="label">
                                <label>Company's Email </label>
                            </div>
                            <input type="email" placeholder="  Email" name="email" required><br>
                        </div>
                        <div class="bform">
                            <div class="label">
                                <label >Password </label>
                            </div>
                            <input type="password" placeholder="  Password" name="password" required id="password" oninput="checkPasswordLength()"><br>
                        </div>
                        <div class="bform">
                            <div class="label">
                                <label >Confirm password </label>
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
                        $name = $_POST['name'];
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
                            $resuslt=mysqli_query($connect,"INSERT INTO employer(employer_name, employer_email, password) VALUES ('$name','$email','$hashpassword')");
                            ?>
                            <script>
                                alert("The company has been successfully added!");
                                window.location.href = "Acompanymanagement.php";
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
        var div = document.getElementById("addemployer");
        div.style.display = "block";  
    }
    function closeFrom(){
        var div = document.getElementById("addemployer");
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
</script>


