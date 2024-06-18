<?php
    include("employer session.php");
    include("dataconnection.php");

    $id = $_SESSION['id'];
                
                
    if(isset($_POST['logout']))
    {
    session_destroy();
    echo'<script>alert("Log-Out successful!");window.location.href="employer login.php";</script>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="employer about us.css">
    <title>About Us</title>
   
</head>
<body>

<header>
    <div class="logo">
        <a href="employer home.php"><img src="general_image/jobhelper_logo.png" id="page_logo"/></a>
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

<br/><br/><br/><br/><br/>

<div class="ha">
    <p><b><u>About JH</u></b><br>"Discover job opportunities effortlessly at JH. With a vast database and user-friendly tools, we streamline hiring for employers and empower job seekers. Join us today!"</p>
</div>

<div class="container">
    <h2>Vision</h2>
    <p>"To become the leading platform connecting job seekers with opportunities and empowering employers to find the perfect talent effortlessly."</p>

    <h2>Mission</h2>
    <p>"Our mission is to provide a user-friendly and efficient platform where job seekers can discover diverse employment opportunities tailored to their skills and preferences. We aim to streamline the hiring process for employers by offering innovative tools and comprehensive solutions that enable them to identify, attract, and retain top talent. Through continuous innovation and a commitment to excellence, we strive to make a meaningful impact on the lives of individuals and the success of businesses in the global job market."</p>
</div>

<div class="additional-container">
    <h2>Our Team</h2>
    <div class="position-box">
        <h1>Boss</h1>
        <p>Description of the Big Boss here.</p>
    </div>

    <div class="image-box">
        <img src="jay.jpg" alt="Team Member">
        <p><b>Lo Jin Kai</b></p>
    </div>

    
    <div class="position-box">
        <h1>Boss</h1>
        <p>Description of the Big Boss here</p>
    </div>

  
    <div class="image-box">
        <img src="jay.jpg" alt="Team Member">
        <p><b>Vincent Tay Yong Jun</b></p>
    </div>

    <div class="position-box">
        <h1>Boss</h1>
        <p>Description of the Big Boss here.</p>
    </div>

    <div class="image-box">
        <img src="jay.jpg" alt="Team Member">
        <p><b>Goh Cheng Hong</b></p>
    </div>

    <div class="clearfix"></div>
</div>


<footer>
        <nav>
            <ul>
                <li><a href="employer about us.php">About Us</a></li>
                <li><a href="employer contact us.php">Contact Us</a></li>
            </ul>
        </nav>
    </footer>


<script>
     document.getElementById('logoutBtn').addEventListener('click', function() {
        var confirmLogout = confirm('Are you sure you want to logout?');
        if (confirmLogout) {
            window.location.href = 'login.php';
        }
    });

    function userconfirmation()
        {
            answer = confirm("Do you want to log out?");
            return answer;
        }
</script>

</body>
</html>