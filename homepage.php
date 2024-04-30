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

// Query to fetch user's first name from the database based on their email
if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query = "SELECT jobseeker_firstname FROM jobseeker WHERE jobseeker_email = '$email'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row['jobseeker_firstname'];
    }
}

// Query to fetch job posts from the database
$sql = "SELECT * FROM homepage";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Search Homepage</title>
    <style>
        /* General styles */
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

/* Container for job posts */
#jobPosts {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    padding: 20px;
    margin-top: 20px;
}

.jobPost {
    position: relative;
    width: calc(30% - 20px);
    margin-bottom: 20px;
    margin-right: 10px;
    background-color: #f9f9f9;
    border: 2px solid purple;
    border-radius: 5px;
    padding: 10px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.jobPost:last-child {
    margin-right: 0;
}

.jobPost:hover {
    background-color: #e0e0e0;
}

.jobPost img {
    width: 100%;
    border-radius: 5px 5px 0 0;
}

.jobPost h2 {
    font-size: 18px;
    margin-top: 10px;
    margin-bottom: 5px;
}

.jobPost p {
    font-size: 14px;
    margin-top: 5px;
    margin-bottom: 5px;
}

/* Ensure second row starts from the left */
@media (max-width: 1000px) {
    .jobPost {
        width: calc(45% - 20px);
    }
}

@media (max-width: 600px) {
    .jobPost {
        width: calc(100% - 20px);
    }
}

/* Search bar styles */
#searchBar {
    width: 80%;
    padding: 10px;
    margin-top: 20px;
    margin-left: 80px;
    border: 1px solid black;
    border-radius: 5px;
}

/* Love icon styles */
.saveIcon {
    position: absolute;
    bottom: 5px;
    right: 5px;
    font-size: 20px;
    color: black;
    cursor: pointer;
}

.saved {
    color: red; 
}

/* Styles for the welcome message */
.user-info {
    display: inline-block;
    padding: 8px 16px;
    border: 2px solid green; /* Change the border color */
    border-radius: 5px;
    margin-left: 50px; 
}

.user-info p {
    margin: 0;
    font-weight: bold;
    color: green; /* Change the text color */
}

.user-info:hover {
    background-color: green; /* Change the background color on hover */
}

.user-info:hover p {
    color: white; /* Change the text color on hover */
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
                <li><a href="profile.php?email=<?php echo urlencode($_SESSION['email']); ?>">Profile</a></li> <!-- Update the href attribute -->
                <li><a href="#">Company Profile</a></li>
            </ul>
        </nav>

        <!-- Display user's first name -->
        <div class="user-info">
            <?php 
            if(isset($firstName)) {
                echo '<p>Welcome, ' . $firstName . '</p>';
            }
            ?>
        </div>

        <div class="employer-site">
            <a href="#">Employer Site</a>
        </div>
    </header>

    <!-- Search bar -->
    <input type="text" id="searchBar" placeholder="Search...">

    <div id="jobPosts">
        <?php
        // Loop through each row in the result set
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Generate job post container for each row with an id
                echo '<div class="jobPost" id="' . $row["company_name"] . '">';
                echo '<img src="' . $row["logo_url"] . '" alt="Company Logo">';
                echo '<h2>' . $row["company_name"] . '</h2>';
                echo '<p>Salary: ' . $row["salary_range"] . '</p>';
                echo '<p>' . $row["job_description"] . '</p>';
                echo '<span class="saveIcon">&#10084;</span>'; // Love icon
                echo '</div>';
            }
        } else {
            echo "No job posts available";
        }
        ?>
    </div>

    <script>
        const searchBar = document.getElementById('searchBar');
        const jobPosts = document.getElementById('jobPosts');

        searchBar.addEventListener('input', function() {
            const searchText = searchBar.value.trim().toLowerCase();
            const posts = jobPosts.querySelectorAll('.jobPost');

            posts.forEach(post => {
                const companyName = post.querySelector('h2').textContent.trim().toLowerCase();
                if (companyName.includes(searchText)) {
                    post.style.display = 'block';
                } else {
                    post.style.display = 'none';
                }
            });
        });

        // Function to handle saving/un-saving job posts
        function toggleSaveJobPost(icon) {
            const post = icon.parentNode;
            const postId = post.id;
            // Toggle the saved state of the job post
            icon.classList.toggle('saved');
        }

        // Add click event listener to each love icon
        const saveIcons = document.querySelectorAll('.saveIcon');
        saveIcons.forEach(icon => {
            icon.addEventListener('click', function(event) {
                // Prevent default action (e.g., following a link)
                event.preventDefault();
                // Call the toggleSaveJobPost function
                toggleSaveJobPost(icon);
            });
        });
    </script>
</body>
</html>
<?php
// Close database connection
$conn->close();
?>