<?php include('vdataconnection.php'); ?>
<?php include('employer session.php'); ?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <link rel="icon" href="img/logo.png">
        <title>
            Packages | Job Help
        </title>
        <link rel="stylesheet" type="text/css" href="employer packages.css">
        <link rel="icon" href="general_image/jobhelper_logo.png">
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
            <button id="logout" name="logout" onclick='return userconfirmation();'><img src='img/logout.png' id="logout_photo">LOG OUT</button>
        </form>
    </header>

                </div>
            </div>
        </nav>


   
<br/><br/>


    <br/><hr/><br/>



    <h1 class="center">Our packages</h1>

    
    <?php
    
    $result = mysqli_query($connect, "SELECT * FROM package WHERE package_sale_status = '1'");	
     while($row = mysqli_fetch_assoc($result))
        {
        
        ?>	
        <form  method="post">
        <table border="0"   class="formBox">
        <tr>   
            <td rowspan="1">
                
            
                <input type="hidden" name="pid" value="<?php echo $row["package_id"] ?>">

                <div id="shipx"><u><?php echo $row['package_name']?></u></div><br/>
                
                <div id="erpx" ><?php echo $row['package_description']?> <br/><br/><br/>
                <h1>RM<?php echo $row["package_price"] ?></h1>
                <input type="hidden" name="price" value="<?php echo $row["package_price"] ?>">
                    <input type="hidden" name="post_number" value="<?php echo $row["package_post_quota"] ?>">
                
                
                    <button  type="submit" name="buy_package" onclick="buy();">Buy</button>
            </td>
            
            
            
        </tr>
        </table>
        </form>
            <br>




        <?php } ?>


   


    <?php
    /*
              if (isset($_POST['buy_package'])) 
              {
                $pt = $_POST['post_number'];
                $price = $_POST['price'];
                $pid = $_POST['pid'];
                $id = $_REQUEST['id'];
                $result = mysqli_query($connect, "SELECT balance FROM employer WHERE id = '$id'");
                //select the row first


                if ($result) 
                {
                    $row = mysqli_fetch_assoc($result);
                    $balance = $row['balance'];
                    mysqli_free_result($result);
                }
                //declare the $balance is the $row['balance']
                
                //after above step then can add number to balance 
                    $balance += $pt ;
                    
            
                    mysqli_query($connect, "UPDATE employer SET balance = '$balance' WHERE id = '$id'");
                    mysqli_query($connect,"  INSERT INTO sale 
                    ( purchase_amount, payment_status, employer_id, package_id) 
                    VALUES ('$price', 'Successful', $id, '$pid');")
                    
                    ?>
                    
                    <script>
                       
                        window.location = "employer packages.php?id=<?php echo urlencode($id);?>";

                    </script>


                    <?php
                } 
                */
                ?>
          

          <?php
    
              if (isset($_POST['buy_package'])) 
              {
                $pid = $_POST['pid'];
             
                
                    
                ?>
                <script>
                
                window.location = "employer buy.php?pid=<?php echo $pid ?>";

                </script>

                <?php
            
                
                
                    
                } 
                
                ?>
      

        <script>
        function confirmbuy()
        {
        answer = confirm("Do you want to buy this this?");
        if(answer == true)
        {
            alert("You are successfully buy this package.");
        }
        return answer;
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