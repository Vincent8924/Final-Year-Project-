<?php include('vdataconnection.php'); ?>
<?php include('employer session.php'); ?>
<html> 
<head>
    <meta charset="UTF-8"/> 
    <title>
        Payment | Job Help
    </title>
    <link rel="stylesheet" type="text/css" href="employer buy.css">
    <link rel="icon" href="img/logo.png">
</head>

<body>

<br/> <br/>

    <?php
                        
                            $id = $_SESSION['id'];
                            $ppid = $_REQUEST["pid"];
                            

                            if(isset($_POST['logout']))
            {
                session_destroy();
                echo'<script>alert("Log-Out successful!");window.location.href="employer login.php";</script>';
            }


            $result = mysqli_query($connect,"SELECT * FROM package WHERE package_id = '$ppid'");

            if($result)
            {
                $row = mysqli_fetch_assoc($result);
                $pnum = $row['package_post_quota'];
                $pname = $row['package_name'];
                $pprice = $row['package_price'];
                $pt = $row['package_post_quota'];
                mysqli_free_result($result);
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

<?php
    
    


if(isset($_POST['submit']))
    {
        $error = 0;

      
        $method = $_POST['method'];
        $card_name = $_POST['card_name'];
        $card_number = $_POST['card_number'];
        $card_expire_year = $_POST['card_expire_year'];
        $card_expire_month = $_POST['card_expire_month'];
        $card_CVV = $_POST['card_CVV'];
        $card_number_length = strlen($card_number);
        $card_CVV_length = strlen($card_CVV);

    
    

    if(empty($card_name))
    {
        $card_name_error ="Card Name Required";
        $error = 1;
    }
    else if(!preg_match("/^[a-zA-Z ]*$/", $card_name))
    {
        $card_name_error = "Only Letter are allowed";
        $error = 1;
    }

    if(empty($card_number))
    {
        $card_number_error = "Card Number Required";
        $error =1;
    }
    else if($card_number_length != 16){
        $card_number_error = "Invalid Card Number";
        $error = 1;
    }
    
    if(empty($card_expire_year))
    {
        $card_expire_year_error = "Card Expire Year Required";
        $error = 1;
    }

    if(empty($card_expire_month))
    {
        $card_expire_month_error = "Card Expire Month Required";
        $error = 1;
    }
    else if(0 > $card_expire_month || $card_expire_month > 12)
    {
        $card_expire_month_error = "Invalid Card Expire Month";
        $error = 1;
    }

    if(empty($card_CVV))
    {
        $card_CVV_error = "Card CVV Required";
    }
    else if($card_CVV_length != 3)
    {
        $card_CVV_error ="Invalid Card CVV";
    }
   
    if ($error == 0) {
        $method;
        $card_name = $_POST['card_name'];
        $card_number = $_POST['card_number'];
        $card_expire_year = $_POST['card_expire_year'];
        $card_expire_month = $_POST['card_expire_month'];
        $card_CVV = $_POST['card_CVV'];
        $card_number_length = strlen($card_number);
        $card_CVV_length = strlen($card_CVV);


        mysqli_query($connect,"  INSERT INTO sale 
                    (purchase_amount, payment_status, employer_id, package_id,bank,card_name,card_number,card_expire_year,card_expire_month,card_cvv) 
                    VALUES ('$pprice', 'Successful', $id, '$ppid','$method','$card_name','$card_number','$card_expire_year','$card_expire_month','$card_CVV');");

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

        ?>

        <script>
            alert("You are successfully buy this package");
            window.location = "employer packages.php";
        </script>
            

        <?php


        //header("Location:employer packages.php");
    } else {
        $msg = "Please fill all fields";
    }

}
    
?>


        <div class="Payment">
            <div class="title">
                 <h2>PAYMENT</h2>
                 <br/>
                 <p>You may use any payment method by filling in our payment form.</p>
            </div>
            </div>
            </br>
            
            <div class="order">
                <h3>Order Details:</h3>
                <br/>

                

                <table>
                    <tr>
                        <th>
                            Package Name : 
                        </th>
                        <td>
                            <?php
                                echo $pname;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Post Quota : 
                        </th>
                        <td>
                            <?php
                                echo $pnum;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Package Price : 
                        </th>
                        <td>
                            <?php
                                echo $pprice;
                            ?>
                        </td>
                    </tr>



                </table>

       
                <br/>
                
            </div><br/><br/>
        

            <div class="payment">
                <form method="post">

                    <div class="formBox">
                      
                        <div id ="slideshow" class="container">
                            <h3>Card Accepted:</h3>

                            <br/>

                            <div class="method-image">
                                <img src="img\master-card.png" class="active">
                                <img src="img\CIMB.png">
                                <img src="img\Paypal.png">
                                <img src="img\visa.png">          
                            </div>

                        </div>


                        <br/>

                        <select class ="inputBox100" name="method" required>
                            <option value="" selected hidden>Select Your Bank or Payment Method</option>
                            <option value="MASTER CARD">MASTER CARD</option>                       
                            <option value="CIMB">CIMB</option> 
                            <option value="PAYPAL">PAYPAL</option> 
                            <option value="VISA">VISA</option> 
                        </select>
                                            
                        <div class="row50">
                            <div class="inputBox">
                                <label for="card_name">Card Name</label>
                                <input type="text" name="card_name" placeholder="Enter your Card Name">
                                <span class="text-danger"><?php if(!empty($card_name_error)){echo $card_name_error;}?></span>
                            </div>


                            <div class="inputBox">
                                <label for="card_number">Card Number</label>
                                <input type="text" name="card_number" placeholder="Enter your Card 16 Number">
                                <span class="text-danger"><?php if(!empty($card_number_error)){echo $card_number_error;}?></span>
                            </div>                     
                        </div>


                        <div class="row50">

                            <span class="inputBox30">
                                <label for="card_expire_year">Card Expire Year</label>
                                <input type="text" name="card_expire_year" placeholder="Enter Card Expire Year">
                                <span class="text-danger"><?php if(!empty($card_expire_year_error)){echo $card_expire_year_error;}?></span>
                            </span>

                            <span class="inputBox30">
                            
                                <label for="card_expire_month">Card Expire Month</label>
                                <input type="text" name="card_expire_month" placeholder="Enter Card Expire Month">
                                <span class="text-danger"><?php if(!empty($card_expire_month_error)){echo $card_expire_month_error;}?></span>
                            </span>

                            <span class="inputBox30">
                                <label for="card_CVV">CVV</label>
                                <input type="text" name="card_CVV" placeholder="Enter CVV 3 number">
                                <span class="text-danger"><?php if(!empty($card_CVV_error)){echo $card_CVV_error;}?></span>
                            </span> 

                        </div>

                        <div class="button-area">

                        <br>

                            <input type="submit" name="submit" onclick="return confirmation();">
                            <p id="success"></p> 
                            <div class="error"><?php if(!empty($msg)){echo $msg;}?></div>  

                        </div> 


                        </div>                       
                    </div>
                    
                </form>

            
        </div>


        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
        $(function() {
            var images = $(".container img"); 

            var currentIndex = 0; 

            setInterval(function() {
                images.eq(currentIndex).removeClass("active"); 

                currentIndex = (currentIndex + 1) % images.length; 

                images.eq(currentIndex).addClass("active");
            }, 3000); 
        });
        function confirmation()
{
	answer = confirm("Do you want to submit your payment?");
	return answer;
}
    </script>
    


<br><br><br><br>    
</body>
</html>
