<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="uprofile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            width: 90%;
            margin: 0 auto;
        }

        #line {
            padding-right: 15px;
            padding-left: 15px;
            background-color: black;
            background-repeat: repeat-x;
            height: 100px;
        }

        .choice a {
            font-size: 30px;
            text-decoration: none;
            color: white;
            margin-left: 35px;
            position: relative;
            display: inline-block;
            top: 25px;
        }

        .left {
            float: left;
            margin-right: 65px;
        }

        .right {
            float: right;
            margin-right: 65px;
        }

        #page_logo {
            height: 45px;
            top: 0px;
        }

        .center {
            text-align: center;
        }

        .formbox {
            position: relative;
            max-width: max-content;
            max-height: max-content;
            box-shadow: 0 2px 5px black;
            padding: 30px 40px;
            border-radius: 10px;
        }

        button {
            width: 100px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #000;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        .centerButton {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        #profile_photo_space {
            border: 5px solid rgb(0, 0, 0);
            width: 20%;
            display: flex;
        }

        #profile_photo {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .profile {
            font-size: 20px;
        }
    </style>
</head>
</head>

<body>
    <header class="header">
        <h1>User Profile</h1>
        <div>
           
        </div>
    </header>
    
    <div class="uAccBar" id="uAccBar">
        <div class="bAccBar">
            <a href="Uprofile.php">Profile</a>
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
            echo'<script>alert("Log-Out successful!");window.location.href="Ulogin.php";</script>';
        }
    ?>
    <div class="container">
        <aside>
            <nav class="Menu">
                <ul>
                    <li><a href="Udashboard.php">Dashboard</a></li>
                    <li><a href="Uprofile.php" id="now">Profile</a></li>
                    <!-- Add more menu items for other sections if needed -->
                </ul>
            </nav>
        </aside>
        <main>
            <h1>User Profile</h1>
            <div class="Ucontainer">
                <div class="Uinfo">
                    <!-- Assuming you fetch user data from the database -->
                    <table>
                        <tbody>
                            <
                            <tr>
                                <td class="Utd"><i class="fa-solid fa-user"></i>  ID</td>
                                <td class="colontd">:</td>
                         
                                <td class="btntd"></td>
                            </tr>
                            <tr>
                                <td class="Utd"><i class="fa-solid fa-signature"></i>  First Name</td>
                                <td class="colontd">:</td>
                          
                                <td class="btntd">
                                    <button onclick="editfname()" class="edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Add more rows for other fields -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modals for editing different fields -->

    <!-- Modal for editing first name -->
    <div id="editfname">
        <form method="POST">
            <div class="Uform">
                <div class="x" >
                    <button type="button" onclick="closeeditfname()" id="x">x</button>
                </div>
                
                <h2>Edit First Name</h2>
                <br>
                <div class="Uformfield">
                    <div class="label">
                        <label >First Name </label>
                    </div>
                    <input type="text" value="<?php echo"$fname"?>" name="fname" required><br>
                </div>
                <br>
                <input type="submit" value="Edit" class="formbtn" name="editfname">   
            </div>
        </form>
    </div>

    <!-- Add more modals for other fields like last name, email, etc. -->

    <footer>
        <p>JobHelper&trade;</p>
    </footer>

    <!-- JavaScript functions -->
    <script>
        function displaybar()
        {
            var div = document.getElementById("uAccBar");
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

        // Add functions for editing other fields as required

        // Function to open modal for editing first name
        function editfname(){
            var div = document.getElementById("editfname");
            div.style.display = "block";  
        }

        // Function to close modal for editing first name
        function closeeditfname(){
            var div = document.getElementById("editfname");
            div.style.display = "none";  
        }
    </script>
</body>
</html>