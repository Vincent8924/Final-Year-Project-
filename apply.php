<?php
include("Jsession.php");
include("dataconnection.php");
$id = $_SESSION['id'];
$postId = $_REQUEST['post_id'];




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


        if (isset($_POST['submit'])) {
            // if (isset($_FILES['resume']) && isset($_FILES['coverLetter']) && isset($_POST['post_id'])) {
                
                $post = mysqli_query($connect,"SELECT * FROM post WHERE post_id = '$postId'");
                if ($post) {
                    $row = mysqli_fetch_assoc($post);
                    $poster_id = $row['poster_id'];
                }

                $resume = $_FILES['resume'];
                $coverLetter = $_FILES['coverLetter'];
        
                // Perform necessary validations on files (e.g., file type, size)
                // Insert logic to handle file uploads securely and store in a secure location
                
                // Example: Move uploaded files to a directory
                $resumeFileName = 'resume_' . time() . '_' . $resume['name'];
                $coverLetterFileName = 'cover_letter_' . time() . '_' . $coverLetter['name'];

                $resumeFilePath = 'uploads/' . $resumeFileName;
                $coverLetterFilePath = 'uploads/' . $coverLetterFileName;

                move_uploaded_file($resume['tmp_name'], $resumeFilePath);
                move_uploaded_file($coverLetter['tmp_name'], $coverLetterFilePath);

                
        
                // Example: Update database with file paths
                $result = mysqli_query($connect, "INSERT INTO applications (jobseeker_id, post_id,poster_id, `resume`, cover_letter) VALUES ('$id', '$postId','$poster_id', '$resumeFilePath', '$coverLetterFilePath')");
        
                if ($result) {
                    echo '<script>alert("Apply successfully!");</script>';
                } else {
                    echo '<script>alert("Error occurred while applying!");</script>';
                }
            // }
        }
    else 
    {
      //  echo '<script>alert("Please select both resume and cover letter files.");</script>';
    }


// Retrieve post details if post_id is provided
if(isset($_GET['post_id'])) {
    $postId = $_GET['post_id'];

    $result = mysqli_query($connect,"SELECT * FROM post WHERE post_id = $postId");

    if($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $companyName = $row['company_name'];
        $logo = $row['logo'];
        $description = $row['description']; 
        $job = $row['job_name'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="apply.css">
    <title>Apply for Job</title>
  
</head>
<body>
<header>
  <div class="logo">
            <img src="new.jpg" alt="Company Logo">
        </div>
        <nav class="navigation">
            <ul>
            <li><a href="homepage.php?email=<?php echo urlencode($_SESSION['id']); ?>">Homepage</a></li>
            <li><a href="jobsave.php?email=<?php echo urlencode($_SESSION['id']); ?>">Job save</a></li>
            <li><a href="profile.php?email=<?php echo urlencode($_SESSION['id']); ?>">Profile</a></li>
              
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

<div id="applyForm">
<?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row["logo"]) . '" alt="logo" style="height: 150px; margin-bottom: 20px;">'; ?>
    <h2>Apply for <?php echo  $job  ?></h2>
    <p><?php echo $description ?></p>
    <form enctype="multipart/form-data" method="post">
        <div>
            <label for="resume">Upload Resume:</label>
            <input type="file" id="resume" name="resume">
        </div>
        <div>
            <label for="coverLetter">Upload Cover Letter:</label>
            <input type="file" id="coverLetter" name="coverLetter">
        </div>
        <input type="hidden" name="post_id" value="<?php echo $postId ?>">
        <button type="submit" name="submit">Submit Application</button>
    </form>
</div>



    <footer>
        <nav>
            <ul>
            <li><a href="aboutus.php?email=<?php echo urlencode($_SESSION['id']); ?>">About us</a></li>
            <li><a href="contact.php?email=<?php echo urlencode($_SESSION['id']); ?>">Contact us</a></li>
            <li><a href="applylist.php?email=<?php echo urlencode($_SESSION['id']); ?>">Apply list</a></li>
                
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