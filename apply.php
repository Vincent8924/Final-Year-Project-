<?php
session_start();
include("dataconnection.php");

if(isset($_GET['post_id'])) {
    $postId = $_GET['post_id'];
    $query = "SELECT * FROM post WHERE post_id = $postId";
    $result = $connect->query($query);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $companyName = $row['company_name'];
        $logo = $row['logo'];
        $description = $row['description'];
    } else {
        // Handle error if post is not found
    }
} else {
    // Handle error if post_id is not provided
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Job</title>
    <style>
         /* Add your styles here */
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
    <h2>Apply for <?php echo $companyName; ?></h2>
   
    <p><?php echo $description; ?></p>
    <form action="check_apply.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="resume">Upload Resume:</label>
            <input type="file" id="resume" name="resume">
        </div>
        <div>
            <label for="coverLetter">Upload Cover Letter:</label>
            <input type="file" id="coverLetter" name="coverLetter">
        </div>
        <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
        <input type="submit" value="Submit Application">
    </form>
</div>
    <footer>
        <nav>
            <ul>
                <li><a href="aboutus.html">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="#">Privacy Policy</a></li>
                
            </ul>
        </nav>
    </footer>
</body>
</html>