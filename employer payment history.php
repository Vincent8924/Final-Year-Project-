<?php include('vdataconnection.php'); ?>
<?php include('employer session.php'); ?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>
            Payment History | Job Help
        </title>
        <link rel="stylesheet" type="text/css" href="employer payment history.css">
        <link rel="icon" href="img/logo.png">
    </head>
    <body>

    
    <br/> <br/>
    <?php
                        
                            $id = $_SESSION['id'];
                            

                            if(isset($_POST['logout']))
            {
                session_destroy();
                echo'<script>alert("Log-Out successful!");window.location.href="employer login.php";</script>';
            }


            

                    ?>
        <nav>
            <div id="line">
                <div class="choice">
                    <span class="left">
                    <a href="employer home.php"><img src="img/page logo2.png" id="page_logo"/></a>
                    </span>    
                    <span class="mid"> 

                    
                    <a href="employer home.php">HOME</a>
                        <a href="employer drafts.php">Drafts</a>
                        <a href="employer view post.php">Post</a>
                        <a href="employer view application.php">Application</a>
                        <a href="employer packages.php">Package</a>
                        <a href="employer payment history.php">History</a>
                        <a href="employer profile.php">Profile</a>
                    
                    </span>
                    <form method="post" >
                        <span class="right" >
                            <button id="logout" name="logout" onclick='return userconfirmation();'><img src='img/logout.png' id="logout_photo">LOG OUT</button>
                        </span> 
                    </form>
                </div>
            </div>
        </nav>


    <br/><hr/><br/>

    <h1>Your payment history</h1>

    <br/>

    <table>
            <tr>
                <th>Pyament time</th>
                <th>Card Name</th>
                <th>Package Name</th>
                <th>Payment Amount</th>
                <th>Bank or Method</th>
            </tr>

<?php
    $result = mysqli_query($connect,"SELECT * FROM `sale` WHERE employer_id = '$id'");
    while($row = mysqli_fetch_assoc($result))
    {
    
        $pid = $row['package_id'];


        $pp = mysqli_query($connect,"SELECT * FROM `package` WHERE package_id = '$pid'");

        if($pp)
        {
            $prow = mysqli_fetch_assoc($pp);
            
            $pname = $prow['package_name'];
        }


?>
            <tr>
                <td><?php echo $row['purchase_time']; ?></td>
                <td><?php echo $row['card_name']; ?></td>
                <td><?php echo $pname ?></td>
                <td><?php echo $row['purchase_amount']; ?></td>
                <td><?php echo $row['bank']; ?></td>
            </tr>

<?php
}
?>

    </table>