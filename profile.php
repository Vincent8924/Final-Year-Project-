<?php
include('dataconnection.php');
include('Jsession.php');

ob_start();

$firstName = '';

if (isset($_SESSION['id'])) 
    $id = $_SESSION['id'];
    $id = $connect->real_escape_string($id);

    $query = "SELECT jobseeker_firstname FROM jobseeker WHERE jobseeker_id = '$id'";
    $result = $connect->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row['jobseeker_firstname'];
    }
?>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Profile | Job Help</title>
   
    <link rel="icon" href="img/logo.png">
    <style>
  body {
    margin: 0;
    font-family: 'Times New Roman', Times, serif;
    background-image: url('jt.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000; 
    background-color: white;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navigation {
    display: inline-block;
    margin-right: 50%;
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

.employer-site {
    display: inline-block;
    padding: 8px 16px;
    border: 2px solid blue;
    border-radius: 5px;
    margin-right: 20px;
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

.user-info {
    display: inline-block;
    padding: 8px 16px;
    border: 2px solid green;
    border-radius: 5px;
    margin-left: 50px;
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
.center {
    text-align: center;
}

.formbox {
    max-width: 400px;
    margin: 0 auto;
    padding: 30px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.formbox h2 {
    margin-bottom: 20px;
    color: #333;
    font-size: 24px;
    font-weight: bold;
    text-align: center;
}

.formbox label {
    display: block;
    margin-bottom: 10px;
    color: #333;
    font-weight: bold;
}

.formbox input[type="text"],
.formbox input[type="email"],
.formbox textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.formbox button {
    width: 100%;
    padding: 10px;
    border: none;
    background-color: #007bff;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.formbox button:hover {
    background-color: #0056b3;
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
    width: 150px;
    height: 150px;
    border-radius: 50%;
    overflow: hidden;
    border: 5px solid #007bff;
    margin: 20px auto;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

#profile_photo {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
}

.profile {
    font-size: 20px;
}

#logout_photo {
    width: 15px;
}

.container {
    margin: 100px auto;
    max-width: 800px;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.8); 
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}
.profile-section {
    margin-bottom: 20px;
}

.profile-section h2 {
    margin-bottom: 10px;
    color: #333;
    font-size: 24px;
    font-weight: bold;
}

.profile-section p {
    margin: 0;
    color: #666;
    font-size: 18px;
}

#profile_photo_space {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    overflow: hidden;
    border: 5px solid #007bff;
    margin: 20px auto;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.edit-button {
    display: block;
    width: 150px;
    margin: 20px auto 0;
    text-align: center;
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.edit-button:hover {
    background-color: #0056b3;
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
<br/><br/>
<?php
$id = $_SESSION['id'];
if (isset($_POST['logout'])) {
    session_destroy();
    echo '<script>alert("Log-Out successful!");window.location.href="login.php";</script>';
}
?>
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
        
        <div class="employer-site">
            <a href="employer sign up.php">Employer Site</a>
        </div>
    </header>
    

<?php
$result = mysqli_query($connect, "SELECT * FROM jobseekerprofile where jobseeker_id = '$id' LIMIT 1");
if ($result) {
    $row = mysqli_fetch_assoc($result);
?>
<div class="container">
    <div id="profile_photo_space">
        <img id="profile_photo" src="data:image/png;base64,<?php echo base64_encode($row['photo_data']); ?>" alt="Photo">
    </div>
    <div class="profile-section">
        <h2>Personal Summary</h2>
        <p><?php echo $row['PersonalSummary']; ?></p>
    </div>
    <div class="profile-section">
        <h2>Work Experience</h2>
        <p><?php echo $row['work_experience']; ?></p>
    </div>
    <div class="profile-section">
        <h2>Education</h2>
        <p><?php echo $row['Education']; ?></p>
    </div>
    <div class="profile-section">
        <h2>Skills</h2>
        <p><?php echo $row['Skills']; ?></p>
    </div>
    <div class="profile-section">
        <h2>Language</h2>
        <p><?php echo $row['language']; ?></p>
    </div>
    <div class="profile-section">
        <h2>Resume</h2>
        <p><a href="view_resume.php?id=<?php echo $id; ?>">View Resume</a></p>
    </div>
    <div class="profile-section">
        <button onclick="window.location.href='edit profile.php?id=<?php echo $id; ?>'" class="edit-button">Edit Profile</button>
    </div>
</div>
<?php
}
?>
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