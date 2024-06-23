<?php
include("Jsession.php");
include("dataconnection.php");

if (!$connect) {
    die("Database connection failed: " . mysqli_connect_error());
}

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

$sql = "SELECT * FROM post";
$result = $connect->query($sql);

if (!$result) {
    die("Query failed: " . $connect->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="homepage.css">
    <title>Job Search Homepage</title>
    <style>
       
        </style>
</head>
<body>
<header>
        <div class="logo">
        <img src="../Final-Year-Project-/general_image/jobhelper_logo.png" alt="JobStreet Logo">
        </div>
        <nav class="navigation">
            <ul>
            <li><a href="homepage.php?email=<?php echo urlencode($_SESSION['id']); ?>">Homepage</a></li>  
                <li><a href="jobsave.php?email=<?php echo urlencode($_SESSION['id']); ?>">Job Save</a></li>
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
        </div>
        <div class="employer-site">
            <a href="employer sign up.php">Employer Site</a>
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
   while ($row = $result->fetch_assoc()) {
    $poster = ($row["poster_id"]);
    echo '<div class="jobPost" id="post_' . htmlspecialchars($row["post_id"]) . '">';

    $logogo = mysqli_query($connect,"SELECT * FROM employer_profile WHERE profile_id = '$poster'");
    $logogo_row = mysqli_fetch_assoc($logogo);

    echo '<img src="data:image/jpeg;base64,' . base64_encode($logogo_row["photo_data"]) . '" alt="logo" onclick="showForm(' . htmlspecialchars($row["post_id"]) . ')">';
    echo '<h2>' . htmlspecialchars($row["job_name"]) . '</h2>';
    echo '<p>'. htmlspecialchars($row["company_name"]) . '</p>'; 
    echo '<p class="category">Category: ' . htmlspecialchars($row["category"]) . '</p>';
    echo '<p>Employment type: ' . htmlspecialchars($row["employment_type"]) . '</p>';
    echo '<p>Location: ' . htmlspecialchars($row["location"]) . '</p>';
    echo '<button class="applyButton" onclick="applyJob(' . htmlspecialchars($row["post_id"]) . ')">Apply</button>';
    echo '<button class="wishlistButton" onclick="saveToWishlist(' . htmlspecialchars($row["post_id"]) . ')">Save to Wishlist</button>';
    echo '</div>';
}
    ?>

    </div>
    <div id="slideForm" class="slide-form">
    <button id="closeForm" class="close-form">&times;</button>
    <div id="formContent">
      
    </div>
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
        function saveToWishlist(postId) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "wishlist.php?post_id=" + postId, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert(xhr.responseText);
            } else {
                alert("An error occurred while saving to wishlist.");
            }
        };
        xhr.send();
    }


        function applyJob(postId) {
            window.location.href = 'apply.php?post_id=' + postId;
        }
        document.getElementById('logoutBtn').addEventListener('click', function() {
        var confirmLogout = confirm('Are you sure you want to logout?');
        if (confirmLogout) {
            window.location.href = 'login.php';
        }
    });

    function showForm(postId) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "getPostDetails.php?post_id=" + postId, true); 
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('formContent').innerHTML = xhr.responseText;
            document.getElementById('slideForm').classList.add('open');
            document.getElementById('slideForm').classList.remove('closed'); 
        } else {
            alert("An error occurred while fetching post details.");
        }
    };
    xhr.send();
}
document.querySelectorAll('.jobPost img').forEach(logo => {
    logo.addEventListener('click', function(event) {
        event.stopPropagation(); 
        const postId = this.parentElement.id.split('_')[1]; 
        showForm(postId);
    });
});

    document.getElementById('closeForm').addEventListener('click', function() {
    document.getElementById('slideForm').classList.remove('open');
    document.getElementById('slideForm').classList.add('closed'); 
});
    </script>
    <footer>
        <nav>
            <ul>
            <li><a href="aboutus.php?email=<?php echo urlencode($_SESSION['id']); ?>">About us</a></li>
            <li><a href="contact.php?email=<?php echo urlencode($_SESSION['id']); ?>">Contact us</a></li>
            
            </ul>
        </nav>
    </footer>
</body>
</html>
<?php
$connect->close();
?>
 