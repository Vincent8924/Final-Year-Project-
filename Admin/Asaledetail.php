<?php 
    include("../Admin/Adataconnection.php");
    include("../Admin/Asession.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Asaledetail.css">
</head>

<body>
    <header class="header">
        <h1>JobHelper</h1>
        <div>
            <a  class="AdminAcc" onclick="displaybar()">
                <?php
                    $id = $_SESSION['id'];

                    $result = mysqli_query($connect,"SELECT * FROM admin where admin_id='$id'");
                    if($result)
                    {
                        $row = mysqli_fetch_assoc($result);
                        $fname = $row["admin_fname"];
                    }
                ?>
                <?php echo"$fname"; ?>            
            </a>
        </div>
    </header>
    
    <div class="aAccBar" id="aAccBar">
        <div class="bAccBar">
            <a href="Aprofile.php">Profile</a>
        </div>
        <div class="bAccBar">
            <form action="" method="POST" id="logout">
                <input type="submit" name="logout" value="Log-Out">
            </form>
        </div>
    </div>
    <?php
        if(isset($_POST['logout']))
        {
            session_destroy();
            echo'<script>alert("Log-Out successful!");window.location.href="Alogin.php";</script>';
        }
    ?>
    <div class="container">
        <aside>
            <nav class="Menu">
                <ul>
                    <li><a href="Adashboard.php" >Dashboard</a></li>
                    <li><a href="Aseekermanagement.php">Seeker</a></li>
                    <li><a href="Acompanymanagement.php">Companies</a></li>
                    <li><a href="Aadminmanagement.php">Admin</a></li>
                    <li><a href="Apost.php">Post</a></li>
                    <li><a href="Apackage.php">Package</a></li>
                    <li><a href="Asale.php" id="now">Sale</a></li>
                    <li><a href="Aprofile.php">Profile</a></li>
                </ul>
            </nav>
        </aside>
        <main>
            <a href="Asale.php" class="back"><h2>< Back</h2></a>

            <?php 
                $id=$_REQUEST['saleid'];
                
                $result = mysqli_query($connect, "SELECT * FROM sale WHERE sale_id=$id;");
                $row = mysqli_fetch_assoc($result);
                if($row)
                {
                    $employer_id = $row["employer_id"];
                    $employer_result = mysqli_query($connect, "SELECT employer_name FROM employer WHERE id='$employer_id'");
                    $employer_row = mysqli_fetch_assoc($employer_result);
                    $employer_name = $employer_row['employer_name'];
                    
                    $package_id = $row["package_id"];
                    $package_result = mysqli_query($connect, "SELECT package_name FROM package WHERE package_id='$package_id'");
                    $package_row = mysqli_fetch_assoc($package_result);
                    $package_name = $package_row['package_name'];

                    $sale_id = $row["sale_id"];
                    $purchase_amount = $row["purchase_amount"]; 
                    $purchase_time = $row["purchase_time"]; 
                    $payment_status = $row["payment_status"]; 
                    $bank = $row["bank"]; 
                    $card_name = $row["card_name"]; 
                    $card_number = $row["card_number"]; 
                    $card_expire_year = $row["card_expire_year"]; 
                    $card_expire_month = $row["card_expire_month"]; 
                    $card_cvv = $row["card_cvv"]; 
            ?>
                    <div class="Acontainer">
                        <div class="Aheader">
                            <div class="id">
                                <h3>ID : <?php echo $sale_id; ?></h3>
                            </div>
                            <div class="amount">
                                <h3>RM <?php echo $purchase_amount; ?></h3>
                            </div>
                        </div>
                        <div class="Bcontainer">
                            <h4>Buyer</h4>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="Atd">ID</td>
                                        <td class="colontd">:</td>
                                        <td class="valuetd"><?php echo $employer_id; ?></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                    </div>

            <?php

                }
            ?>
        </main>
    </div>

    <footer>
        <p>JobHelper&trade;</p>
    </footer>

</body>
</html>

<SCript>
    function displaybar()
    {
        var div = document.getElementById("aAccBar");
        var divdisplay = window.getComputedStyle(div);

        if(divdisplay.display === "block" )
        {
            div.style.display = "none";  
        }
        else 
        {
            div.style.display = "block"; 
        }
    }
</SCript>
