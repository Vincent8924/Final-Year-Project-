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
    <title>About Us</title>
    <style>
     
       
        header {
            background-color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navigation {
            display: inline-block;
            margin-left: 20px;
        }

        .navigation ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .navigation ul li {
            display: inline-block;
            margin-right: 20px;
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
        .user-info {
            display: inline-block;
            padding: 8px 16px;
            border: 2px solid green;
            border-radius: 5px;
            margin-left: 60%;
        }

        .user-info p {
            margin: 0;
            font-weight: bold;
            color: green;
        }

        .user-info:hover {
            background-color: green;
        }

        .user-info:hover p {
            color: white;
        }

        
        .employer-site {
            display: inline-block;
            padding: 8px 16px; 
            border: 2px solid blue; 
            border-radius: 5px; 
        }

      
        .employer-site a {
            text-decoration: none;
            color: rgb(12, 12, 191); 
        }

       
        .employer-site:hover {
            background-color: blue; 
        }

        
        .employer-site:hover a {
            color: white; 
        }

        .logo {
            display: inline-block;
        }

        .logo img {
            height: 50px; 
        }

        .navigation {
            font-family: 'Times New Roman', Times, serif;
            display: inline-block;
            margin-left: 20px; 
        }

        .navigation ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .navigation ul li {
            display: inline-block;
            margin-right: 20px;
        }

       

        .employer-site {
            display: inline-block;
        }

        body {
            padding: 0;
            margin: 0;
            font-family: Arial, sans-serif; 
            line-height: 1.6; 
        }

       
        .content {
            padding: 20px;
            margin-top: 20px; 
        }

  
        .ha {
            background-image: url('ha.jpg');
            background-size: cover;
            background-position: center;
            height: 550px; 
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative; 
        }

        .ha p {
            text-align: center;
            color: rgb(18, 16, 16);
            font-size: 16px; 
            position: absolute; 
            top: 50%; 
            transform: translateY(-50%); 
            width: 30%; 
            padding: 50px; 
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 5px; 
            margin-right: 45%;
            margin-top: 5%;
        }

        .container {
            width: 80%; 
            max-width: 1500px;
            margin: 20px auto; 
            padding: 20px;
            background-color: white; 
            border-radius: 10px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        }

        .container h2 {
            text-align: center; 
            color: #333; 
        }

        
        .additional-container {
            width: 80%; 
            max-width: 1500px; 
            margin: 20px auto; 
            padding: 20px; 
            background-color: white; 
            border-radius: 10px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        }

        .additional-container h2 {
            text-align: center; 
            color: #333;
        }
    
.position-box,
.image-box {
    width: calc(50% - 20px); 
    height: 200px; 
    margin-right: 20px;
    margin-bottom: 20px; 
    float: left; 
    background-color: #ede8ec; 
    border-radius: 10px; 
    box-shadow: 0 0 5px rgba(239, 237, 237, 0.1); 
    text-align: center; 
}
       
        .image-box {
            width: calc(20% - 20px);
            float: right; 
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); 
            text-align: center; 
        }

        
        .image-box img {
            max-width: 50%;
            height: auto;
        }

       
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        footer {
            background-color: white;
            padding: 10px 20px;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0px -1px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        footer nav ul {
            font-family: 'Times New Roman', Times, serif;
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 20px;
        }

        footer nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            transition: color 0.3s;
        }

        footer nav ul li a:hover {
            color: #555;
        }
        
    </style>
</head>
<body>

<header>
    <div class="logo">
        <img src="new.jpg" alt="Company Logo">
    </div>

    <nav class="navigation">
        <ul>
        <li><a href="homepage.php?email=<?php echo urlencode($_SESSION['id']); ?>">Homepage</a></li>
            <li><a href="profile.php?email=<?php echo urlencode($_SESSION['id']); ?>">Profile</a></li>
         
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
        <li><a href="contact.php?email=<?php echo urlencode($_SESSION['id']); ?>">Contact us</a></li>
        <li><a href="applylist.php?email=<?php echo urlencode($_SESSION['id']); ?>">Apply list</a></li>
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