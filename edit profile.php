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
    <link rel="stylesheet" type="text/css" href="edit profile.css">
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

    
    $targetFilePath = '';
    $targetDirectory = 'resume/';
    if (mysqli_num_rows($result) > 0) {
      
        $query = "UPDATE jobseekerprofile SET PersonalSummary = '$PersonalSummary', work_experience = '$work_experience', Education = '$Education', Skills = '$Skills', language = '$language'";

        if ($photo_name && $photo_data) {
            $query .= ", photo_name = '$photo_name', photo_data = '$photo_data'";
        }

        if ($Resume) {
            $targetDirectory = 'resume/';
            $targetFilePath = $targetDirectory . basename($Resume);

            if (!is_dir($targetDirectory)) {
                mkdir($targetDirectory, 0755, true);
            }

            if (move_uploaded_file($_FILES['Resume']['tmp_name'], $targetFilePath)) {
              
                $query .= ", Resume = '$targetFilePath'";
            } else {
              
                echo '<script>alert("Error uploading resume.");</script>';
            }
        }

        $query .= " WHERE jobseeker_id = '$id'";
    } else {
      
        $query = "INSERT INTO jobseekerprofile (photo_name, photo_data, PersonalSummary, work_experience, Education, Skills, language, Resume, jobseeker_id) 
        VALUES ('$photo_name', '$photo_data', '$PersonalSummary', '$work_experience', '$Education', '$Skills', '$language', '$targetFilePath', '$id')";

        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0755, true);
        }

        if ($Resume && move_uploaded_file($_FILES['Resume']['tmp_name'], $targetFilePath)) {
            
            $query .= ", Resume = '$targetFilePath'";
        }
    }

    if (mysqli_query($connect, $query)) {
        echo '<script>
                alert("Profile saved successfully!");
                window.location.href = "profile.php";
              </script>';
    } else {
        echo '<script>alert("Error saving profile.");</script>';
    }
}
?>
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