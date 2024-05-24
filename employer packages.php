<?php include('vdataconnection.php'); ?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>
            Packages | Job Help
        </title>
        <link rel="stylesheet" type="text/css" href="employer packages.css">
        <link rel="icon" href="img/logo.png">
    </head>
    <body>

    
    <br/> <br/>
    <?php
                        {
                        $id = $_REQUEST["id"];
                    ?>
        <nav>
            <div id="line">
                <div class="choice">
                    <span class="left">
                        <a href="employer home.php?id=<?php echo urlencode($id);?>"><img src="img/page logo2.png" id="page_logo"/></a>
                    </span>    
                    <span class="mid"> 

                    
                        <a href="employer home.php?id=<?php echo urlencode($id);?>">HOME</a>
                        <a href="employer drafts.php?id=<?php echo urlencode($id);?>">Drafts</a>
                        <a href="employer view post.php?id=<?php echo urlencode($id);?>">Post</a>
                        <a href="employer packages.php?id=<?php echo urlencode($id);?>">Package</a>
                        <a href="employer profile.php?id=<?php echo urlencode($id);?>">Profile</a>
                    
                    </span>
                    <span class="right" >
                    <a href='index.php' onclick='return userconfirmation();'><img src='img/logout.png' style='width: 20px; height: 20px;'>LOG OUT</a></span> 
                    
                </div>
            </div>
        </nav>

        <?php
                        }
                    ?>
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
                
                
                    <button  type="submit" name="buy_package" onclick="return confirmbuy();">Buy</button>
            </td>
            
            
            
        </tr>
        </table>
        </form>
            <br>




        <?php } ?>


   


    <?php
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


    </body>