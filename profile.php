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
    <link rel="stylesheet" type="text/css" href="profile.css">
    <link rel="icon" href="img/logo.png">
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
    <h2> View Resume</h2>
    <?php
    $query = "SELECT Resume FROM jobseekerprofile WHERE jobseeker_id = '$id'";
    $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $resumePath = $row['Resume'];
        echo '<p>Current Resume: <a href="'.$resumePath.'" target="_blank">'.basename($resumePath).'</a></p>';
    }
    ?>
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