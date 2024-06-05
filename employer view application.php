<?php include('vdataconnection.php'); ?>
<?php include('employer session.php'); ?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>
            Application | Job Help
        </title>
        
        <link rel="icon" href="img/logo.png">
        <style>
            body {
    background-image: url('i.jpg');
   
    background-size: 100% 160%;
    font-family: 'Times New Roman', Times, serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}
header {
    background-color: #ffffff;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000; 
}

.navigation {
    margin-right: 50%;
    margin-top: 20px;
    font-size: 20px;
    display: flex;
    gap: 20px;
}

.navigation ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
    display: flex;
    gap: 20px;
}

.navigation ul li {
    display: inline-block;
}

.navigation ul li a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    transition: color 0.3s;
}

.navigation ul li a:hover {
    color: #555;
}

.logo img {
    height: 50px;
    width: 50px;
    margin-left: 30px;
}

#logout {
    font-size: 20px;
    width: 100px;
    margin-top: -10px;
}

.left 
{
    float: left; /* 元素右浮动 */
    margin-right: 65px;
    
}



.right  
{
    float: right; /* 元素右浮动 */
    margin-right: 65px;
}



.formBox {
    max-width: 800px;
    margin: 30 auto;
    padding: 30px;
    background-color: rgba(249, 249, 249, 0.8); 
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    opacity: 0.9; 
    border: 1px solid #000; 
}


.formBox .field {
    height: 50px;
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #000; 
    border-radius: 5px;
    box-sizing: border-box;
}

    .formBox h1 {
        text-align: center;
        margin-bottom: 20px;
    }

   
    .formBox button {
        font-family: 'Times New Roman', Times, serif;
        width: 100%;
        padding: 10px;
        border: none;
        background-color: #007bff;
        color: white;
        font-size: 16px;
        font-weight: bold;
        border-radius: 5px;
        cursor: pointer;
    }

   
    .formBox button:hover {
        background-color: #0056b3;
    }

    
    .formBox hr {
        margin-top: 30px;
        margin-bottom: 30px;
        border: 0;
        border-top: 1px solid #ccc;
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

  
#logout
{
    font-size: 15px;
    width: 150px;
    margin-right:40px ;
    margin-top: 10px;
    border: none;
}

#logout_photo
{
    width: 15px; 
    
}

        </style>
        
    </head>
    <body>
    <br/> <br/>

    <?php
                        
                            $id = $_SESSION['id'];
                            

                            if(isset($_POST['logout']))
            {
                session_destroy();
                echo'<script>alert("Log-Out successful!");window.location.href="employer login.php";</script>';
            }


            $result = mysqli_query($connect,"SELECT * FROM employer WHERE id = '$id'");

            if($result)
            {
                $row = mysqli_fetch_assoc($result);
                $balance = $row['balance'];
                mysqli_free_result($result);
            }

                    ?>
        <header>
    <div class="logo">
        <a href="employer home.php"><img src="img/page logo2.png" id="page_logo"/></a>
    </div>
    <nav class="navigation">
        <ul>
            <li><a href="employer home.php">Home</a></li>
            <li><a href="employer drafts.php">Drafts</a></li>
            <li><a href="employer view post.php">Post</a></li>
            <li><a href="employer view application.php">Application</a></li>
            <li><a href="employer packages.php">Package</a></li>
            <li><a href="employer payment history.php">History</a></li>
            <li><a href="employer profile.php">Profile</a></li>
        </ul>
    </nav>
    <form method="post" >
       
            <button id="logout" name="logout" onclick='return userconfirmation();'><img src='img/logout.png' id="logout_photo">LOG OUT</button>
        </div> 
    </form>
</header>

                </div>
            </div>
        </nav>


    
    <br/><hr/><br/>

    <h1>Manage the application</h1>
        <br/><br/>