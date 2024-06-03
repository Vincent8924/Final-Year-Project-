<?php
include('dataconnection.php'); 
include('jsession.php'); 

ob_start();
?>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>profile | Job Help</title>
    <link rel="icon" href="img/logo.png">
    <style>
        body {
    width: 90%;
    margin: 0 auto;
    font-family: 'Times New Roman', Times, serif;
    background-image: url('it.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
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
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
    margin-top: -9px;
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

#logout {
    font-size: 15px;
    width: 150px;
    margin-right: 130px;
    margin-top: 10px;
    border: none;
    background-color: #007bff;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

#logout:hover {
    background-color: #0056b3;
}

#logout_photo {
    width: 15px;
}

.container {
    margin: 100px auto;
    max-width: 800px;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

.profile-section {
    margin-bottom: 20px;
    background-color:darkgrey;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s, box-shadow 0.3s;
}

.profile-section:hover {
    background-color: #e9ecef;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
    </style>
</head>
<body>
<br/><br/>
<?php
$id = $_SESSION['id'];
if (isset($_POST['logout'])) {
    session_destroy();
    echo '<script>alert("Log-Out successful!");window.location.href=" login.php";</script>';
}

if (isset($_POST['save_profile'])) {
    $photo_data = addslashes(file_get_contents($_FILES['photo_data']['tmp_name']));
    $PersonalSummary = $_POST['PersonalSummary'];
    $work_experience = $_POST['work_experience'];
    $Education = $_POST['Education'];
    $Skills = $_POST['Skills'];
    $language = $_POST['language'];
    $Resume = addslashes(file_get_contents($_FILES['Resume']['tmp_name']));

    $query = "INSERT INTO jobseekerprofile (photo_name, photo_data, PersonalSummary, work_experience, Education, Skills, language, Resume, jobseeker_id) 
              VALUES ('$photo_name', '$photo_data', '$PersonalSummary', '$work_experience', '$Education', '$Skills', '$language', '$Resume', '$id')";

    if (mysqli_query($connect, $query)) {
        echo '<script>alert("Profile saved successfully!");</script>';
    } else {
        echo '<script>alert("Error saving profile.");</script>';
    }
}
?>
<header>
    <div class="logo">
        <a href="jobseeker home.php"><img src="img/page logo2.png" id="page_logo"/></a>
    </div>
    <nav class="navigation">
        <ul>
            <li><a href="homepage.php">job search</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="applylist.php">apply list</a></li>
        </ul>
    </nav>
    <form method="post">
        <button id="logout" name="logout" onclick='return userconfirmation();'>
            <img src='img/logout.png' id="logout_photo"> LOG OUT
        </button>
    </form>
</header>
<br/><hr/><br/>

<form method="post" enctype="multipart/form-data">
    <div class="profile-section">
        <h2>Profile Picture</h2>
        <input type="file" name="photo_data" accept="image/*">
    </div>
    <div class="profile-section">
        <h2>Personal Summary</h2>
        <textarea name="PersonalSummary" rows="4" cols="50"></textarea>
    </div>
    <div class="profile-section">
        <h2>Work Experience</h2>
        <textarea name="work_experience" rows="4" cols="50"></textarea>
    </div>
    <div class="profile-section">
        <h2>Education</h2>
        <textarea name="Education" rows="4" cols="50"></textarea>
    </div>
    <div class="profile-section">
        <h2>Skills</h2>
        <input type="text" name="Skills">
    </div>
    <div class="profile-section">
        <h2>Language</h2>
        <input type="text" name="language">
    </div>
    <div class="profile-section">
        <h2>Resume</h2>
        <input type="file" name="Resume" accept=".pdf">
    </div>
    <button type="submit" name="save_profile" class="save-button">Save Profile</button>
</form>

</body>
</html>
<?php
ob_end_flush();
?>