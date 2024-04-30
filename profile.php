<?php
// Start session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobstreet";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables to store jobseeker information
$firstName = "";
$lastName = "";
$email = "";

// Check if email parameter is set
if(isset($_GET['email'])) {
    $email = $_GET['email'];
    
    // Query to fetch jobseeker's information based on email
    $query = "SELECT * FROM jobseeker WHERE jobseeker_email = '$email'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        // Fetch jobseeker's information
        $row = $result->fetch_assoc();
        $firstName = $row['jobseeker_firstname'];
        $lastName = $row['jobseeker_lastname'];
        // $email is already assigned from GET parameter
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        /* Your CSS styles */
        /* Header styles */
        header {
            background-color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navigation {
            display: inline-block;
            margin-left: 3%;
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

        .navigation {
            display: inline-block;
            margin-right: 45%;
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
            margin-left: auto;
            margin-right: 30px;
        }

        /* Profile styles */
        .profile {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .profile h1 {
            margin-bottom: 20px;
        }

        .profile-info {
            margin-bottom: 20px;
        }

        .profile-info p {
            margin: 5px 0;
        }

        /* Form styles */
        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            margin-top: 5px;
        }

        .edit-icon {
            font-size: 20px;
            color: #007bff;
            cursor: pointer;
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

        <div class="employer-site">
            <a href="#">Employer Site</a>
        </div>
    </header>

    <div class="profile">
        <h1>Jobseeker Profile</h1>

        <!-- Profile photo upload -->
        <!-- Your profile photo upload code -->

        <div class="profile-info">
            <p><strong>Name:</strong> <?php echo $firstName . ' ' . $lastName; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <!-- Add more profile information here (e.g., skills, education, work experience) -->
        </div>
        <!-- Add more sections for skills, education, work experience, etc. -->

        <!-- Additional form for bio, skills, education, experience, and resume -->
        <form>
            <div class="form-group">
                <label for="bio">Bio:</label>
                <textarea id="bio" name="bio"></textarea>
            </div>
            <div class="form-group">
                <label for="skills">Skills:</label>
                <input type="text" id="skills" name="skills">
            </div>
            <div class="form-group">
                <label for="education">Education:</label>
                <input type="text" id="education" name="education">
            </div>
            <div class="form-group">
                <label for="experience">Experience:</label>
                <input type="text" id="experience" name="experience">
            </div>
            <div class="form-group">
                <label for="resume">Upload Resume:</label>
                <input type="file" id="resume" name="resume">
            </div>
            <button type="button" onclick="saveProfile()" class="edit-icon">&#9998;</button>
        </form>
    </div>

    <script>
        function saveProfile() {
            // Your JavaScript code to save the profile information goes here
            alert("Profile information saved!");
        }
    </script>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>