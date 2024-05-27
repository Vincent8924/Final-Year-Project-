<?php
session_start();
include("dataconnection.php");

// Function to handle form submission
function processApplication() {
    global $connect;
    
    if(isset($_FILES['resume']) && isset($_FILES['coverLetter']) && isset($_POST['post_id'])) {
        $postId = $_POST['post_id'];
        $resume = $_FILES['resume'];
        $coverLetter = $_FILES['coverLetter'];
        
        // Perform necessary validations on files (e.g., file type, size)
        // Insert logic to handle file uploads securely and store in a secure location
        
        // Example: Move uploaded files to a directory
        $resumeFileName = 'resume_' . time() . '_' . $resume['name'];
        $coverLetterFileName = 'cover_letter_' . time() . '_' . $coverLetter['name'];
        move_uploaded_file($resume['tmp_name'], 'uploads/' . $resumeFileName);
        move_uploaded_file($coverLetter['tmp_name'], 'uploads/' . $coverLetterFileName);
        
        // Example: Update database with file paths
        $query = "INSERT INTO applications (post_id, resume, cover_letter) VALUES ('$postId', '$resumeFileName', '$coverLetterFileName')";
        $result = $connect->query($query);
        
        if($result) {
            echo '<script>alert("Apply successfully!");</script>';
        } else {
            echo '<script>alert("Error occurred while applying!");</script>';
        }
    } else {
        echo '<script>alert("Please select both resume and cover letter files.");</script>';
    }
}

// Check if form is submitted
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    processApplication();
}

// Retrieve post details if post_id is provided
if(isset($_GET['post_id'])) {
    $postId = $_GET['post_id'];
    $query = "SELECT * FROM post WHERE post_id = $postId";
    $result = $connect->query($query);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $companyName = $row['company_name'];
        $logo = $row['logo'];
        $description = $row['description'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Job</title>
    <style>
       
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
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
            margin-left: 20px;
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
            <img src="logo.png" alt="Company Logo">
        </div>
        <nav class="navigation">
            <ul>
                <li><a href="jobsave.php?email=<?php echo urlencode($_SESSION['email']); ?>">Job Save</a></li>
                <li><a href="profile.php?email=<?php echo urlencode($_SESSION['email']); ?>">Profile</a></li>
                <li><a href="#">Company Profile</a></li>
            </ul>
        </nav>
        <div class="user-info">
            <?php
            if (isset($firstName)) {
                echo '<p>Welcome, ' . $firstName . '</p>';
            }
            ?>
        </div>
        <div class="employer-site">
            <a href="#">Employer Site</a>
        </div>
</header>

<div id="applyForm">
    <h2>Apply for <?php echo isset($companyName) ? $companyName : ''; ?></h2>
    <p><?php echo isset($description) ? $description : ''; ?></p>
    <form enctype="multipart/form-data" method="post">
        <div>
            <label for="resume">Upload Resume:</label>
            <input type="file" id="resume" name="resume">
        </div>
        <div>
            <label for="coverLetter">Upload Cover Letter:</label>
            <input type="file" id="coverLetter" name="coverLetter">
        </div>
        <input type="hidden" name="post_id" value="<?php echo isset($postId) ? $postId : ''; ?>">
        <input type="submit" value="Submit Application">
    </form>
</div>
    <footer>
        <nav>
            <ul>
                <li><a href="aboutus.html">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="applylist.php">Apply list</a></li>
                
            </ul>
        </nav>
    </footer>
</body>
</html>