<?php
session_start();
include("dataconnection.php");

// Fetch the list of post IDs that have been applied for
$query = "SELECT DISTINCT post_id FROM applications";
$result = $connect->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
   
    <style>
        body {
            background-color: blanchedalmond; 
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

        table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 8px;
    text-align: left;
}

thead {
    background-color: #f2f2f2;
}

th {
    background-color: #ddd;
    font-weight: bold;
}

tbody tr:nth-child(even) {
    background-color: #f2f2f2;
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
            <li><a href="jobsave.php?email=<?php echo urlencode($_SESSION['jobseeker_email']); ?>">Job Save</a></li>
            <li><a href="profile.php?email=<?php echo urlencode($_SESSION['jobseeker_email']); ?>">Profile</a></li>
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
            // Loop through each applied post ID
            while ($row = $result->fetch_assoc()) {
                $postId = $row['post_id'];
                
                // Fetch the company name and job name for the current post ID
                $postQuery = "SELECT company_name, job_name FROM post WHERE post_id = $postId";
                $postResult = $connect->query($postQuery);
                
                // Check if the post exists
                if ($postResult->num_rows > 0) {
                    $postRow = $postResult->fetch_assoc();
                    $companyName = $postRow['company_name'];
                    $jobName = $postRow['job_name'];
                    
                    // Output the details in a table row
                    echo "<tr>";
                    echo "<td>$postId</td>";
                    echo "<td>$companyName</td>";
                    echo "<td>$jobName</td>";
                    echo "<td>Applied</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</main>


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
</html