<?php
include('dataconnection.php');
include('Jsession.php');

ob_start();

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
        <img src="../Final-Year-Project-/general_image/jobhelper_logo.png" alt="JobStreet Logo">
        </div>
        <nav class="navigation">
            <ul>
            <li><a href="homepage.php?email=<?php echo urlencode($_SESSION['id']); ?>">Homepage</a></li>  
                <li><a href="jobsave.php?email=<?php echo urlencode($_SESSION['id']); ?>">Job Save</a></li>
                <li><a href="profile.php?email=<?php echo urlencode($_SESSION['id']); ?>">Profile</a></li>
                <li><a href="applylist.php?email=<?php echo urlencode($_SESSION['id']); ?>">Apply list</a></li>
            </ul>
        </nav>
        <div class="user-info" id="logoutBtn">
            <?php
            if (!empty($firstName)) {
                echo '<p>Welcome, ' . htmlspecialchars($firstName) . '</p>';
            }
            ?>
        </div>
        
        <div class="employer-site">
            <a href="employer index.php">Employer Site</a>
        </div>
    </header>

<?php
$result = mysqli_query($connect, "SELECT * FROM jobseekerprofile WHERE jobseeker_id = '$id' LIMIT 1");
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $personalSummary = !empty($row['PersonalSummary']) ? $row['PersonalSummary'] : 'No details';
    $workExperience = !empty($row['work_experience']) ? $row['work_experience'] : 'No details';
    $education = !empty($row['Education']) ? $row['Education'] : 'No details';
    $skills = !empty($row['Skills']) ? $row['Skills'] : 'No details';
    $language = !empty($row['language']) ? $row['language'] : 'No details';
?>
<div class="container">
    <div id="profile_photo_space">
        <?php if (!empty($row['photo_data'])): ?>
            <img id="profile_photo" src="data:image/png;base64,<?php echo base64_encode($row['photo_data']); ?>" alt="Photo">
        <?php else: ?>
            <p>No photo available</p>
        <?php endif; ?>
    </div>
    <div class="profile-section">
        <h2>Personal Summary</h2>
        <p><?php echo htmlspecialchars($personalSummary); ?></p>
    </div>
    <div class="profile-section">
        <h2>Work Experience</h2>
        <p><?php echo htmlspecialchars($workExperience); ?></p>
    </div>
    <div class="profile-section">
        <h2>Education</h2>
        <p><?php echo htmlspecialchars($education); ?></p>
    </div>
    <div class="profile-section">
        <h2>Skills</h2>
        <p><?php echo htmlspecialchars($skills); ?></p>
    </div>
    <div class="profile-section">
        <h2>Language</h2>
        <p><?php echo htmlspecialchars($language); ?></p>
    </div>
    <div class="profile-section">
    <h2>View Resume</h2>
    <?php
    if (!empty($row['Resume'])) {
        $resumePath = htmlspecialchars($row['Resume']);
        echo '<p>Current Resume: <a href="download.php?file='.$resumePath.'">'.basename($resumePath).'</a></p>';
    } else {
        echo '<p>No resume available</p>';
    }
    ?>
</div>
    </div>
    <div class="profile-section">
        <button onclick="window.location.href='edit profile.php?id=<?php echo urlencode($id); ?>'" class="edit-button">Edit Profile</button>
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
</body>
</html>