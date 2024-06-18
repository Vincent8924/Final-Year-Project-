<?php
include("Jsession.php");
include("dataconnection.php");

if (!$connect) {
    die("Database connection failed: " . mysqli_connect_error());
}

$firstName = '';

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $id = $connect->real_escape_string($id);

    $query = "SELECT jobseeker_firstname FROM jobseeker WHERE jobseeker_id = '$id'";
    $result = $connect->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row['jobseeker_firstname'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="aboutus.css">
    <title>About Us</title>
   
</head>
<body>

<header>
    <div class="logo">
    <img src="../Final-Year-Project-/general_image/jobhelper_logo.png" alt="JobStreet Logo">
    </div>

    <nav class="navigation">
        <ul>
        <li><a href="homepage.php?email=<?php echo urlencode($_SESSION['id']); ?>">Homepage</a></li>
            <li><a href="profile.php?email=<?php echo urlencode($_SESSION['id']); ?>">Profile</a></li>
            <li><a href="applylist.php?email=<?php echo urlencode($_SESSION['id']); ?>">Apply list</a></li>
         
        </ul>
    </nav>
    <div class="user-info" id="logoutBtn">
    <?php
    if (isset($firstName)) {
        echo '<p>Welcome, ' . $firstName . '</p>';
    }
    ?>
</div>
        </div>
   

    <div class="employer-site">
        <a href="employer sign up.php">Employer Site</a>
    </div>
</header>

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
        <li><a href="aboutus.php?email=<?php echo urlencode($_SESSION['id']); ?>">About us</a></li>
        <li><a href="contact.php?email=<?php echo urlencode($_SESSION['id']); ?>">Contact us</a></li>
       
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
</script>

</body>
</html>