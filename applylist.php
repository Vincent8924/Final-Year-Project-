<?php
session_start();
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

$query = "SELECT DISTINCT post_id FROM applications";
$result = $connect->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="applylist.css">
    <title>Your Page Title</title>
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
        
        <div class="employer-site">
            <a href="employer index.php">Employer Site</a>
        </div>
    </header>
    

<main style="display: flex; justify-content: center;margin-top:5%;">
    <table border="1" style="width: 80%; max-width: 1000px;">
        <thead>
            <tr>
                <th>Apply No</th>
                <th>Company Name</th>
                <th>Job Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $result = mysqli_query($connect, "SELECT * FROM applications where jobseeker_id=$id;");  
                $i = 1;
                while($row = mysqli_fetch_assoc($result)) {
                    
                        $Eid= $row["poster_id"];
                        $postid = $row["post_id"];
                        $status = $row["status"];
                        if(isset($Eid))
                        {
                            $result = mysqli_query($connect, "SELECT * FROM employer where id=$Eid;");
                            $row = mysqli_fetch_assoc($result);
                            $Ename= $row["employer_name"];
                        }

                        if(isset($postid))
                        {
                            $result = mysqli_query($connect, "SELECT * FROM post where post_id=$postid;");
                            $row = mysqli_fetch_assoc($result);
                            $Jname= $row["job_name"];
                        }

                        echo "<tr>";
                        echo "<td>$i</td>";
                        echo "<td>$Ename</td>";
                        echo "<td>$Jname</td>";
                        echo "<td>$status</td>";
                        echo "</tr>";

                        $i++;
                }
            ?>
        </tbody>
    </table>
</main>


<footer>
    <nav>
        <ul>
        <li><a href="aboutus.php?email=<?php echo urlencode($_SESSION['id']); ?>">About us</a></li>
        <li><a href="contact.php?email=<?php echo urlencode($_SESSION['id']); ?>">Contact</a></li>
         
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
</html