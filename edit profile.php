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
    <title>editProfile | Job Help</title>
    <link rel="icon" href="img/logo.png">
    <style>
        body {
            margin: 0;
            font-family: 'Times New Roman', Times, serif;
            background-image: url('jt.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin-top: 70px;
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

        .container {
            margin: 100px auto;
            max-width: 500px;
            padding: 10px;
            background-color: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }

        .profile-section {
            margin-bottom: 10px;
            background-color: darkgrey;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .profile-section:hover {
            background-color: #e9ecef;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-section h2 {
            margin-bottom: 5px;
            color: #333;
            font-size: 20px;
            font-weight: bold;
        }

        .profile-section p {
            margin: 0;
            color: #666;
            font-size: 14px;
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

if (isset($_POST['save_profile'])) {
    $photo_data = !empty($_FILES['photo_data']['tmp_name']) ? addslashes(file_get_contents($_FILES['photo_data']['tmp_name'])) : null;
    $photo_name = !empty($_FILES['photo_data']['name']) ? $_FILES['photo_data']['name'] : null;
    $Resume = !empty($_FILES['Resume']['tmp_name']) ? $_FILES['Resume']['name'] : null;
    $PersonalSummary = $_POST['PersonalSummary'];
    $work_experience = $_POST['work_experience'];
    $Education = $_POST['Education'];
    $Skills = $_POST['Skills'];
    $language = $_POST['language'];

    $query = "SELECT * FROM jobseekerprofile WHERE jobseeker_id = '$id'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        // Update existing profile
        $query = "UPDATE jobseekerprofile SET PersonalSummary = '$PersonalSummary', work_experience = '$work_experience', Education = '$Education', Skills = '$Skills', language = '$language'";

        if ($photo_name && $photo_data) {
            $query .= ", photo_name = '$photo_name', photo_data = '$photo_data'";
        }

        if ($Resume) {
            $targetDirectory = 'uploads/';
            $targetFilePath = $targetDirectory . basename($Resume);
    
            if (move_uploaded_file($_FILES['Resume']['tmp_name'], $targetFilePath)) {
                // File uploaded successfully, update the database with the file path
                $query .= ", Resume = '$targetFilePath'";
            } else {
                // Error occurred while moving the file
                echo '<script>alert("Error uploading resume.");</script>';
            }
        }
    

        $query .= " WHERE jobseeker_id = '$id'";
    } else {
        // Insert new profile
        $query = "INSERT INTO jobseekerprofile (photo_name, photo_data, PersonalSummary, work_experience, Education, Skills, language, Resume, jobseeker_id) 
        VALUES ('$photo_name', '$photo_data', '$PersonalSummary', '$work_experience', '$Education', '$Skills', '$language', '$Resume', '$id')";
    }

    if (mysqli_query($connect, $query)) {
        echo '<script>alert("Profile saved successfully!");</script>';
    } else {
        echo '<script>alert("Error saving profile.");</script>';
    }
}
?>
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

<form method="post" enctype="multipart/form-data">
    <div class="container">
        <div id="profile_photo_space">
            <?php
            // Fetch and display profile picture if it exists
            $query = "SELECT photo_data FROM jobseekerprofile WHERE jobseeker_id = '$id'";
            $result = mysqli_query($connect, $query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo '<img id="profile_photo" src="data:image/jpeg;base64,' . base64_encode($row['photo_data']) . '" />';
            }
            ?>
        </div>
        <div class="profile-section">
            <h2>Profile Picture</h2>
            <input type="file" name="photo_data" accept="image/*">
        </div>
        <div class="profile-section">
            <h2>Personal Summary</h2>
            <textarea name="PersonalSummary" rows="4" cols="50"><?php
            $query = "SELECT PersonalSummary FROM jobseekerprofile WHERE jobseeker_id = '$id'";
            $result = mysqli_query($connect, $query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo htmlspecialchars($row['PersonalSummary']);
            }
            ?></textarea>
        </div>
        <div class="profile-section">
            <h2>Work Experience</h2>
            <textarea name="work_experience" rows="4" cols="50"><?php
            $query = "SELECT work_experience FROM jobseekerprofile WHERE jobseeker_id = '$id'";
            $result = mysqli_query($connect, $query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo htmlspecialchars($row['work_experience']);
            }
            ?></textarea>
        </div>
        <div class="profile-section">
            <h2>Education</h2>
            <textarea name="Education" rows="4" cols="50"><?php
            $query = "SELECT Education FROM jobseekerprofile WHERE jobseeker_id = '$id'";
            $result = mysqli_query($connect, $query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo htmlspecialchars($row['Education']);
            }
            ?></textarea>
        </div>
        <div class="profile-section">
            <h2>Skills</h2>
            <input type="text" name="Skills" value="<?php
            $query = "SELECT Skills FROM jobseekerprofile WHERE jobseeker_id = '$id'";
            $result = mysqli_query($connect, $query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo htmlspecialchars($row['Skills']);
            }
            ?>">
        </div>
        <div class="profile-section">
            <h2>Language</h2>
            <input type="text" name="language" value="<?php
            $query = "SELECT language FROM jobseekerprofile WHERE jobseeker_id = '$id'";
            $result = mysqli_query($connect, $query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo htmlspecialchars($row['language']);
            }
            ?>">
        </div>
        <div class="profile-section">
    <h2>Resume</h2>
    <?php
    $query = "SELECT Resume FROM jobseekerprofile WHERE jobseeker_id = '$id'";
    $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $resumePath = $row['Resume'];
        echo '<p>Current Resume: <a href="'.$resumePath.'" target="_blank">'.basename($resumePath).'</a></p>';
    }
    ?>
    <input type="file" name="Resume" accept=".pdf">
</div>
        <button type="submit" name="save_profile" class="edit-button centerButton">Save Profile</button>
    </div>
</form>
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
<?php
ob_end_flush();
?>