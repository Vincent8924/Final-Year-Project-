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
    <link rel="stylesheet" href="Apackage.css">
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
                    <li><a href="Adashboard.php">Dashboard</a></li>
                    <li><a href="Aseekermanagement.php">Seeker</a></li>
                    <li><a href="Acompanymanagement.php">Companies</a></li>
                    <li><a href="Aadminmanagement.php">Admin</a></li>
                    <li><a href="Apost.php">Post</a></li>
                    <li><a href="Apackage.php" id="now">Package</a></li>
                    <li><a href="Asale.php">Sale</a></li>
                    <li><a href="Aprofile.php">Profile</a></li>
                </ul>
            </nav>
        </aside>
        
        <main>
        <button onclick="displayAdd()" class="addbtn">Add A Package</button>
        <h1>Package</h1>
        <!--On Sale-->
        <div class="Acontainer">
            <?php
                $result = mysqli_query($connect,"SELECT count(*) AS total_available_package FROM package WHERE package_sale_status = 1");
                if($result)
                {
                    $row = mysqli_fetch_assoc($result);
                    $total_available_package = $row["total_available_package"];

                }
            ?>
            <div class="Aheader">
                <div>
                    <h3>On-sales / Available Package</h3>
                </div>
                <div class="amount">
                    <h3>
                        <?php
                            echo $total_available_package;
                        ?>
                    </h3>
                </div>
            </div>
            
            <div class="Bcontainer">
                <?php
                $result = mysqli_query($connect, "SELECT * FROM package WHERE package_sale_status = 1");
                while($row = mysqli_fetch_assoc($result))
                {
                    $package_name = $row["package_name"];
                    $package_id = $row["package_id"];
                    $package_price = $row["package_price"];
                    $package_description = $row["package_description"];
                    $package_post_quota = $row["package_post_quota"];
                    $package_sale_status_index = $row["package_sale_status"];
                    if($package_sale_status_index==1)
                    {
                        $package_sale_status = "On-sales / Available";
                    }
                    else
                    {
                        $package_sale_status = "Off-sales / Unavailable";
                    }
                ?>
                <div class="Apackage">
                    <div class="hApackage">
                        <div>
                            <?php
                                echo $package_name;
                            ?>
                        </div>
                        <div>
                            ID : 
                            <?php
                                echo $package_id;
                            ?>
                        </div>
                    </div>
                    <div class="Bpackage">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="Atd">Package's Price</td>
                                    <td class="Btd"></td>
                                    <td> RM <?php echo $package_price; ?> </td>
                                </tr>
                                <tr>
                                    <td class="Atd">Package's Post Quota</td>
                                    <td class="Btd"></td>
                                    <td> <?php echo $package_post_quota; ?> </td>
                                </tr>
                                <tr>
                                    <td class="Atd">Package's Sale Status</td>
                                    <td class="Btd"></td>
                                    <td> <?php echo $package_sale_status; ?> </td>
                                </tr>
                                <tr>
                                    <td class="Atd">Package's Description</td>
                                    <td class="Btd"></td>
                                    <td> <?php echo $package_description; ?> </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="packagebtn">
                            <form method="POST">
                                <button name="offsale" class="offsalebtn" type="submit" value="<?php echo $package_id; ?>">Offsale</button>
                            </form>
                            <?php
                    
                                if (isset($_POST['offsale'])) 
                                {
                                    $id = $_POST['offsale'];
                                    mysqli_query($connect, "UPDATE package SET package_sale_status = 0 WHERE package_id = '$id'");
                            ?>
                                <script>
                                    alert("The package's sale status has been changed!");
                                    window.location.href = "Apackage.php";
                                </script>
                            <?php
                                }
                            ?>
                        </div>

                    </div>
                </div>
                
            <?php

                }//end while
            ?>

            </div>

        </div>

        <!--Off Sale-->
        <div class="Acontainer">
            <?php
                $result = mysqli_query($connect,"SELECT count(*) AS total_unavailable_package FROM package WHERE package_sale_status = 0");
                if($result)
                {
                    $row = mysqli_fetch_assoc($result);
                    $total_unavailable_package = $row["total_unavailable_package"];

                }
            ?>
            <div class="Aheader">
                <div>
                    <h3>Off-sales / Unavailable Package</h3>
                </div>
                <div class="amount">
                    <h3>
                        <?php
                            echo $total_unavailable_package;
                        ?>
                    </h3>
                </div>
            </div>
            <div class="Bcontainer">
                <?php
                $result = mysqli_query($connect, "SELECT * FROM package WHERE package_sale_status = 0");
                while($row = mysqli_fetch_assoc($result))
                {
                    $package_name = $row["package_name"];
                    $package_id = $row["package_id"];
                    $package_price = $row["package_price"];
                    $package_description = $row["package_description"];
                    $package_post_quota = $row["package_post_quota"];
                    $package_sale_status_index = $row["package_sale_status"];
                    if($package_sale_status_index==1)
                    {
                        $package_sale_status = "On-sales / Available";
                    }
                    else
                    {
                        $package_sale_status = "Off-sales / Unavailable";
                    }
                ?>
                <div class="Apackage">
                    <div class="hApackage">
                        <div>
                            <?php
                                echo $package_name;
                            ?>
                        </div>
                        <div>
                            ID : 
                            <?php
                                echo $package_id;
                            ?>
                        </div>
                    </div>
                    <div class="Bpackage">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="Atd">Package's Price</td>
                                    <td class="Btd"></td>
                                    <td> RM <?php echo $package_price; ?> </td>
                                </tr>
                                <tr>
                                    <td class="Atd">Package's Post Quota</td>
                                    <td class="Btd"></td>
                                    <td> <?php echo $package_post_quota; ?> </td>
                                </tr>
                                <tr>
                                    <td class="Atd">Package's Sale Status</td>
                                    <td class="Btd"></td>
                                    <td> <?php echo $package_sale_status; ?> </td>
                                </tr>
                                <tr>
                                    <td class="Atd">Package's Description</td>
                                    <td class="Btd"></td>
                                    <td> <?php echo $package_description; ?> </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="packagebtn">
                            <form method="POST">
                                <button name="onsale" class="onsalebtn" type="submit" value="<?php echo $package_id; ?>">Onsale</button>
                            </form>
                            <?php
                    
                                if (isset($_POST['onsale'])) 
                                {
                                    $id = $_POST['onsale'];
                                    mysqli_query($connect, "UPDATE package SET package_sale_status = 1 WHERE package_id = '$id'");
                            ?>
                                <script>
                                    alert("The package's sale status has been changed!");
                                    window.location.href = "Apackage.php";
                                </script>
                            <?php
                                }
                            ?>

                            
                        </div>
                    </div>
                </div>

                <?php

                }//end while
                ?>

            </div>

        </div>

        <div id="addpackage">
                <form action="" method="POST">
                    <div class="aform">
                        <div class="x" >
                            <button type="button" onclick="closeAdd()" id="x">x</button>
                        </div>
                        <h2>ADD PACKAGE</h2>
                        
                        <br>
                        <div class="bbform">
                            <div class="bform">
                                <div class="label">
                                    <label for="package_name">Package's Name </label>
                                </div>
                                <input type="text" placeholder="Package's Name " name="name" required><br>
                            </div>
                            <div class="bform">
                                <div class="label">
                                    <label for="package_price">Package's Price </label>
                                </div>
                                <input type="number" placeholder="Package's Price (RM) " name="price" required><br>
                            </div>
                            <div class="bform">
                                <div class="label">
                                    <label for="package_post_quota">Package's Post Quota </label>
                                </div>
                                <input type="number" placeholder="Package's Post Quota" name="post_quota" required><br>
                            </div>
                            <div class="bform">
                                <div class="label">
                                    <label for="package_status">Package's Sale Status </label>
                                </div>
                                <select name="status" class="status">
                                    <option value="" disabled selected hidden>Package's Sale Status</option>
                                    <option value="1">On-Sale</option>
                                    <option value="0">Off-Sale</option>
                                </select>
                            </div>  
                            <div class="bform">
                                <div class="label">
                                    <label for="description">Package's Description</label>
                                </div>
                                <textarea class="desc" name="package_description" placeholder="Package's Description" required></textarea><br><br>
                            </div>
                        </div>

                        <br>
                        <input type="submit" value="Submit" class="formbtn" name="Submit">
                    
                    </div>
 
                </form>
                <?php
                
                    if(isset($_POST['Submit']))
                    {
                        if(isset($_POST['status']))
                        {
                            $name = $_POST['name'];
                            $price = $_POST['price'];
                            $post_quota = $_POST['post_quota'];
                            $status = $_POST['status'];
                            $desc = $_POST['package_description'];

                            $resuslt=mysqli_query($connect,"INSERT INTO package(package_name, package_price, package_post_quota,
                             package_description, package_sale_status) VALUES ('$name','$price','$post_quota','$desc','$status')");
                            ?>
                            <script>
                                alert("Package has been successfully added!");
                                window.location.href = "Apackage.php";
                            </script>
                            <?php
                        }
                        else
                        {
                            ?>
                            <script>
                                alert("Invalid Sale Status!");
                                history.go(-1);
                            </script>
                            <?php
                        }
                    }
                ?>
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
    function confirmdelete(id)
    {
        var confirmed = confirm("Are you sure you want to delete package with ID " + id + "?");

        if(confirmed){
            return true;
        }
        else{
            return false;
            history.go(-1);
        }
    }
    function displayAdd(){
        var div = document.getElementById("addpackage");
        
        div.style.display = "block";  
    }
    function closeAdd(){
        var div = document.getElementById("addpackage");
        div.style.display = "none";  
    }

</script>
