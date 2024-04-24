<?php 
    include("dataconnection.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seeker Management</title>
    <link rel="stylesheet" href="test.css">
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
                    <li><a href="Aseekermanagement.php" id="now">Seeker</a></li>
                    <li><a href="Acompanymanagement.php">Companies</a></li>
                    <li><a href="Aadminmanagement.php">Admin</a></li>
                    <li><a href="Apost.php">Post</a></li>
                    <li><a href="Aprofile.php">Profile</a></li>
                </ul>
            </nav>
        </aside>
        <main>
            <div id="addadmin">
                <form action="">
                    <h2>ADD ADMIN</h2>
                    <div class="form">
                        <div class="label">
                            <label for="admin_fname">Admin's first name </label>
                        </div>
                        <input type="text" placeholder="First Name" name="admin_fname" required><br>
                    </div>
                    <div class="form">
                        <div class="label">
                            <label for="admin_lname">Admin's last name </label>
                        </div>
                        <input type="text" placeholder="Last Name" name="admin_fname" required><br>
                    </div>
                    <div class="form">
                        <div class="label">
                            <label for="admin_email">Admin's Email </label>
                        </div>
                        <input type="email" placeholder="Email" name="admin_email" required><br>
                    </div>
                    <div class="form">
                        <div class="label">
                            <label for="admin_password">Admin's password </label>
                        </div>
                        <input type="admin_password" placeholder="Password" name="admin_password" required><br>
                    </div>
                    <div class="form">
                        <div class="label">
                            <label for="confirm_password">Confirm password </label>
                        </div>
                        <input type="confirm_password" placeholder="Confirm password" name="confirm_password" required><br>
                    </div>
                    <br>

                    <input type="submit" value="submit">
                    
                </form>
            </div>
            <button onclick="display()">add</button>
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