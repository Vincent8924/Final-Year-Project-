<?php
    include("Jsession.php");
    include("dataconnection.php");

        $id = $_SESSION['id'];
       
        
        $result = mysqli_query($connect,"SELECT jobseeker_firstname FROM jobseeker WHERE jobseeker_id = '$id'");
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $firstName = $row['jobseeker_firstname'];
        }
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="homepage.css">

    <title>Job Search Homepage</title>
    
</head>
<body>
<header>
        <div class="logo">
            <img src="logo.png" alt="Company Logo">
        </div>
        <nav class="navigation">
            <ul>
                <li><a href="jobsave.php">Job Save</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="#">Company Profile</a></li>
            </ul>
        </nav>
        <div class="user-info">
            <?php
               echo "Welcome " . $firstName;
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

    $result = mysqli_query($connect,"SELECT * FROM post");


if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $savedClass = ($row["favourite"] === 'yes') ? 'saved' : '';
        echo '<div class="jobPost" id="post_' . htmlspecialchars($row["post_id"]) . '">';
        echo '<img src="' . htmlspecialchars($row["logo"]) . '" alt="logo">';
        echo '<h2>' . htmlspecialchars($row["company_name"]) . '</h2>';
        echo '<p>' . htmlspecialchars($row["job_name"]) . '</p>'; 
        echo '<p class="category">Category: ' . htmlspecialchars($row["category"]) . '</p>';
        echo '<p>Employment type: ' . htmlspecialchars($row["employment_type"]) . '</p>';
        echo '<p>Location: ' . htmlspecialchars($row["location"]) . '</p>';
        echo '<p>Salary: ' . htmlspecialchars($row["salary"]) . '</p>';
        echo '<p>Description: ' . htmlspecialchars($row["description"]) . '</p>';
        echo '<button class="applyButton" onclick="applyJob(' . htmlspecialchars($row["post_id"]) . ')">Apply</button>';
        echo '<span class="saveIcon ' . $savedClass . '" onclick="toggleFavouriteJobPost(this, ' . htmlspecialchars($row["post_id"]) . ')">&#10084;</span>';
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

        searchBar.addEventListener('input', function () {
            const searchText = searchBar.value.trim().toLowerCase();
            const posts = jobPosts.querySelectorAll('.jobPost');

            posts.forEach(post => {
                const companyName = post.querySelector('h2').textContent.trim().toLowerCase();
                const category = post.querySelector('.category').textContent.trim().toLowerCase();

                const searchBy = categorySelector.value;
                const isVisible = searchBy === 'company'
                    ? companyName.includes(searchText)
                    : category.includes(searchText);

                post.style.display = isVisible ? 'block' : 'none';
            });
        });

        function toggleFavouriteJobPost(icon, postId) {
            const request = new XMLHttpRequest();
            request.open('POST', 'jobsave.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.onreadystatechange = function () {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    if (response.status === 'success') {
                        if (response.favourite === 'yes') {
                            icon.classList.add('saved');
                        } else {
                            icon.classList.remove('saved');
                        }
                    } else {
                        alert(response.message);
                    }
                }
            };
            request.send('post_id=' + postId);
        }

        function applyJob(postId) {
            window.location.href = 'apply.php?post_id=' + postId;
        }
    </script>
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
<?php
$connect->close();
?>