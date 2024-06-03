<?php

include('vdataconnection.php'); 
include('employer session.php'); 

ob_start();
?>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Profile | Job Help</title>
    <link rel="stylesheet" type="text/css" href="employer profile.css">
    <link rel="icon" href="img/logo.png">
   
</head>
<body>
<br/><br/>
<?php
$id = $_SESSION['id'];
if (isset($_POST['logout'])) {
    session_destroy();
    echo '<script>alert("Log-Out successful!");window.location.href="employer login.php";</script>';
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
    <form method="post">
        <button id="logout" name="logout" onclick='return userconfirmation();'>
            <img src='img/logout.png' id="logout_photo"> LOG OUT
        </button>
    </form>
</header>
<br/><hr/><br/>
<?php
if (isset($_POST['edit'])) {
    header("Location:employer profile edit.php?id=" . urlencode($id));
    exit(); 
}
$result = mysqli_query($connect, "SELECT * FROM employer_profile where profile_id = '$id'");
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
<div id="profile_photo_space">
    <img id="profile_photo" src="data:image/png;base64,<?php echo base64_encode($row['photo_data']); ?>" alt="Photo">
</div>
<div class="profile-section">
    <h2>Employer/Company Name</h2>
    <p><?php echo $row['name']; ?></p>
</div>
<div class="profile-section">
    <h2>Website</h2>
    <p><?php echo $row['website']; ?></p>
</div>
<div class="profile-section">
    <h2>Industry</h2>
    <p><?php echo $row['industry']; ?></p>
</div>
<div class="profile-section">
    <h2>Company Size</h2>
    <p><?php echo $row['company_size']; ?></p>
</div>
<div class="profile-section">
    <h2>Primary Location</h2>
    <p><?php echo $row['primary_location']; ?></p>
</div>
<div class="profile-section">
    <h2>Description</h2>
    <p><?php echo $row['description']; ?></p>
</div>
<?php
    }
}
?>
<form method="post">
    <button type="submit" name="edit" class="edit-button">Edit Profile</button>
</form>
</body>
</html>
<?php

ob_end_flush();
?>