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
   
    <title>Your Page Title</title>

    <style>
        body {
            background-color: white; 
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
            margin-right: 40%;
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
            width: 80%;
            max-width: 1000px;
            margin-top: 5%;
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

        tbody {
            display: block;
            max-height: 320px; /* Adjust the height as needed for 8 rows */
            overflow-y: auto;
        }

        tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        thead, tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
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

<main style="display: flex; justify-content: center;">
    <table border="1">
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
                $result = mysqli_query($connect, "SELECT * FROM applications WHERE jobseeker_id='$id'");  
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $postid = $row["post_id"];
                    $status = $row["status"];
                    
                    if (isset($postid)) {
                        $postResult = mysqli_query($connect, "SELECT company_name, job_name FROM post WHERE post_id='$postid'");
                        if ($postRow = mysqli_fetch_assoc($postResult)) {
                            $Ename = $postRow["company_name"];
                            $Jname = $postRow["job_name"];
                        }
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
</html>