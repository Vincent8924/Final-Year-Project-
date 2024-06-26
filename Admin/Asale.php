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
    <link rel="stylesheet" href="Asale.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header class="header">
        <img src="../general_image/jobhelper_logo.png" class="logo">
        <div>
            <button class="AdminAcc" onclick="displaybar()">
                <?php
                    $id = $_SESSION['adminid'];

                    $result = mysqli_query($connect,"SELECT * FROM admin where admin_id='$id'");
                    if($result)
                    {
                        $row = mysqli_fetch_assoc($result);
                        $fname = $row["admin_fname"];
                    }
                    
                ?>
                <i class="fa-solid fa-user"></i><?php echo"   $fname"; ?>            
            </button>
        </div>
    </header>
    
    <div class="aAccBar" id="aAccBar">
        <div class="bAccBar">
            <form >
                <input type="button" name="profile" value="Profile" onclick="goProfile()">
            </form>
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
                    <li><a href="Adashboard.php">Dashboard</a></li>
                    <li><a href="Aseekermanagement.php">Seeker</a></li>
                    <li><a href="Acompanymanagement.php">Companies</a></li>
                    <li><a href="Aadminmanagement.php">Admin</a></li>
                    <li><a href="Apost.php">Post</a></li>
                    <li><a href="Apackage.php">Package</a></li>
                    <li><a href="Asale.php" id="now">Sale</a></li>
                    <li><a href="Ahelp.php">Help&Feedback</a></li>
                    <li><a href="Aprofile.php">Profile</a></li>
                </ul>
            </nav>
        </aside>
        <main>
                <?php
                    $result = mysqli_query($connect,"SELECT count(*) AS total_sale FROM sale");
                    if($result)
                    {
                        $row = mysqli_fetch_assoc($result);
                        $total_sale = $row["total_sale"];
                    }
                    $result = mysqli_query($connect,"SELECT SUM(purchase_amount) AS total_sale_amount    FROM sale");
                    if($result)
                    {
                        $row = mysqli_fetch_assoc($result);
                        $total_sale_amount = $row["total_sale_amount"];
                    }
                ?>
                <div class="amount">
                    <h1>
                       RM <?php echo $total_sale_amount?>
                    </h1>
                </div>
                <h1>Sale</h1>
                <div class="Acontainer">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ID</th>
                                <th>Sale Amount</th>
                                <th>Time</th>
                                <th>Buyer/Employer</th>
                                <th>Package/Item</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $result = mysqli_query($connect, "SELECT * FROM sale;");
                                $i = 1;
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    $employer_id = $row["employer_id"];
                                    $employer_result = mysqli_query($connect, "SELECT employer_name FROM employer WHERE id='$employer_id'");
                                    $employer_row = mysqli_fetch_assoc($employer_result);
                                    $employer_name = $employer_row['employer_name'];
                                    
                                    $package_id = $row["package_id"];
                                    $package_result = mysqli_query($connect, "SELECT package_name FROM package WHERE package_id='$package_id'");
                                    $package_row = mysqli_fetch_assoc($package_result);
                                    $package_name = $package_row['package_name'];

                                    

                            ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $row["sale_id"] ?></td>
                                        <td><?php echo $row["purchase_amount"] ?></td>
                                        <td><?php echo $row["purchase_time"] ?></td>
                                        <td><?php echo $employer_name ?></td>
                                        <td><?php echo $package_name ?></td>
                                        <td class="view">
                                            <button type="button" onclick="view(<?php echo $row['sale_id']; ?>)">View</button>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            ?>
                        </tbody>
                        
                    </table>
                </div>
        </main>
    </div>

    <footer>
        <p>JobHelper&trade;</p>
    </footer>

</body>
</html>

<script>
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
    function view(id)
    {
        window.location = "Asaledetail.php?saleid="+id;
    }
</script>
