<?php include('vdataconnection.php'); ?>
<?php include('employer session.php'); ?>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Payment History | Job Help</title>
    <link rel="stylesheet" type="text/css" href="employer payment history.css">
    <link rel="icon" href="general_image/jobhelper_logo.png">
</head>
<body>
<?php
$id = $_SESSION['id'];
if(isset($_POST['logout'])) {
    session_destroy();
    echo '<script>alert("Log-Out successful!");window.location.href="employer login.php";</script>';
}
?>
<header>
    <div class="logo">
        <a href="employer home.php"><img src="general_image/jobhelper_logo.png" id="page_logo"/></a>
    </div>
    <nav class="navigation">
        <ul>
            <li><a href="employer home.php">Home</a></li>
            <li><a href="employer drafts.php">Drafts</a></li>
            <li><a href="employer view post.php">Post</a></li>
            <li><a href="employer view application.php">Application</a></li>
            <li><a href="employer packages.php">Package</a></li>
            <li><a href="employer payment history.php">History</a></li>
            <li><a href="employer profile.php">Profile</a></li>
        </ul>
    </nav>
    <form method="post">
        <button id="logout" name="logout" onclick='return userconfirmation();'>
            <img src='img/logout.png' id="logout_photo"> LOG OUT
        </button>
    </form>
</header>

<div class="content">
    <h1>Your Payment History</h1>
    <div class="table-container">
        <table>
            <tr>
                <th>Payment Time</th>
                <th>Card Name</th>
                <th>Package Name</th>
                <th>Payment Amount</th>
                <th>Bank or Method</th>
            </tr>
            <?php
            $result = mysqli_query($connect, "SELECT * FROM `sale` WHERE employer_id = '$id'");
            while($row = mysqli_fetch_assoc($result)) {
                $pid = $row['package_id'];
                $pp = mysqli_query($connect, "SELECT * FROM `package` WHERE package_id = '$pid'");
                if($pp) {
                    $prow = mysqli_fetch_assoc($pp);
                    $pname = $prow['package_name'];
                }
            ?>
            <tr>
                <td><?php echo $row['purchase_time']; ?></td>
                <td><?php echo $row['card_name']; ?></td>
                <td><?php echo $pname; ?></td>
                <td><?php echo $row['purchase_amount']; ?></td>
                <td><?php echo $row['bank']; ?></td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>
<script>
    function userconfirmation() {
        return confirm("Are you sure you want to log out?");
    }
</script>

<footer>
        <nav>
            <ul>
                <li><a href="aboutus.html">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </nav>
    </footer>

</body>
</html>