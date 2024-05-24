<?php
session_start();
include("dataconnection.php");

if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $email = $connect->real_escape_string($email);  
    $query = "SELECT jobseeker_firstname FROM jobseeker WHERE jobseeker_email = '$email'";
    $result = $connect->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row['jobseeker_firstname'];
    }
}

$sql = "SELECT * FROM post";
$result = $connect->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Search Homepage</title>
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

        #searchContainer {
            display: flex;
            align-items: center;
            width: 80%;
            margin: 20px auto 0;
        }

        #searchBar {
            flex: 1;
            padding: 10px;
            border: 1px solid black;
            border-radius: 5px 0 0 5px;
        }

        #categorySelector {
            padding: 10px;
            border: 1px solid black;
            border-left: none;
            border-radius: 0 5px 5px 0;
            background-color: #fff;
            cursor: pointer;
        }

        #categorySelector:focus {
            outline: none;
        }

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
            if(isset($firstName)) {
                echo '<p>Welcome, ' . $firstName . '</p>';
            }
            ?>
        </div>
        <div class="employer-site">
            <a href="#">Employer Site</a>
        </div>
    </header>
    <div id="searchContainer">
        <input type="text" id="searchBar" placeholder="Search...">
        <select id="categorySelector">
            <option value="company">Company</option>
            <option value="category">Category</option>
        </select>
    </div>
    <div id="jobPosts">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="jobPost" id="' . htmlspecialchars($row["job_name"]) . '">';
                echo '<img src="' . htmlspecialchars($row["logo"]) . '" alt="logo">';
                echo '<h2>' . htmlspecialchars($row["company_name"]) . '</h2>';
                echo   htmlspecialchars($row["job_name"]) ;
                echo '<p class="category">Category: ' . htmlspecialchars($row["category"]) . '</p>'; 
                echo '<p>Employment type: ' . htmlspecialchars($row["employment_type"]) . '</p>';
                echo '<p>Location: ' . htmlspecialchars($row["location"]) . '</p>';
                echo '<p>Salary: ' . htmlspecialchars($row["salary"]) . '</p>';
                echo '<p>Description:' . htmlspecialchars($row["description"]) . '</p>';
                echo '<span class="saveIcon">&#10084;</span>'; 
                echo '</div>';
            }
        } else {
            echo "No job posts available";
        }
        ?>
    </div>
    <script>
        const searchBar = document.getElementById('searchBar');
        const categorySelector = document.getElementById('categorySelector');
        const jobPosts = document.getElementById('jobPosts');

        searchBar.addEventListener('input', function() {
            const searchText = searchBar.value.trim().toLowerCase();
            const posts = jobPosts.querySelectorAll('.jobPost');

            posts.forEach(post => {
                const companyName = post.querySelector('h2').textContent.trim().toLowerCase();
                const category = post.querySelector('p.category').textContent.trim().toLowerCase();
                if (categorySelector.value === 'company' && companyName.includes(searchText)) {
                    post.style.display = 'block';
                } else if (categorySelector.value === 'category' && category.includes(searchText)) {
                    post.style.display = 'block';
                } else {
                    post.style.display = 'none';
                }
            });
        });

        function toggleSaveJobPost(icon) {
            const post = icon.parentNode;
            const postId = post.id;
            icon.classList.toggle('saved');
        }

        const saveIcons = document.querySelectorAll('.saveIcon');
        saveIcons.forEach(icon => {
            icon.addEventListener('click', function(event) {
                event.preventDefault();
                toggleSaveJobPost(icon);
            });
        });

        categorySelector.addEventListener('change', function() {
            searchBar.dispatchEvent(new Event('input'));
        });

        
    </script>
</body>
</html>
<?php
$connect->close();
?>