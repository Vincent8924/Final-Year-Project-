<?php include('database_connection.php'); ?>
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
                        $email = $_REQUEST["email"];
                    ?>
        <nav>
            <div id="line">
                <div class="choice">
                    <span class="left">
                    <a href="employer home.php?home&email=<?php echo urlencode($email);?>"><img src="img/page logo2.png" id="page_logo"/></a>
                    </span>    
                    <span class="mid"> 

                    
                        <a href="employer home.php?home&email=<?php echo urlencode($email);?>">HOME</a>
                        <a href="employer drafts.php?draft&email=<?php echo urlencode($email);?>">Drafts</a>
                        <a href="employer packages.php?packages&email=<?php echo urlencode($email);?>">Package</a>
                        <a href="employer profile.php?profile&email=<?php echo urlencode($email);?>">Profile</a>
                    
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

    

    <table class="mid_table">
        <tr>
            <td>
                <form class="formbox" method="post">
                    <div class="center">
                        <h1><u>1 Post Package</u></h1>
                        
                        <h2>
                            allow post one post
                            <br/><br/>
                            without time limited
                        </h2>

                        <h1>RM8.00</h1>
                        <input type="hidden" name="post_number" value="1">
                    </div>


                
                <button class="centerButton" type="submit" name="buy_package" onclick="return confirmbuy();">Buy</button>
                
                <br/><br/>

                </form>
            </td>

            <td>
                <form class="formbox" method="post">
                        <div class="center">
                            <h1><u>5 Post Package</u></h1>
                            

                            <h2>
                                allow post two post
                            <br/><br/>
                                without time limited
                            </h2>

                          
                        

                            <h1>RM35.00</h1>
                            <input type="hidden" name="post_number" value="5">
                        </div>


                    
                    <button class="centerButton" type="submit" name="buy_package" onclick="return confirmbuy();">Buy</button>
                    
                    <br/><br/>

                </form>
            
            </td>

            <td>
                <form class="formbox" method="post">
                        <div class="center">
                            <h1><u>10 post package</u></h1>
                            

                            <h2>
                                allow post two post
                            <br/><br/>
                                without time limited
                            </h2>

                          
                        

                            <h1>RM60.00</h1>
                            <input type="hidden" name="post_number" value="10">


                        </div>


                    
                    <button class="centerButton" type="submit" name="buy_package" onclick="return confirmbuy();">Buy</button>
                    
                    <br/><br/>

                </form>
            
            </td>
                    
        </tr>
    </table>


    <?php
              if (isset($_POST['buy_package'])) 
              {
                $pt = $_POST['post_number'];
                $email = $_REQUEST['email'];
                $result = mysqli_query($connect, "SELECT balance FROM employer WHERE employer_email = '$email'");
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
                    
            
                    mysqli_query($connect, "UPDATE employer SET balance = '$balance' WHERE employer_email = '$email'");
                    
                    
                    ?>
                    
                    <script>
                       
                        window.location = "employer packages.php?email=<?php echo urlencode($email);?>";

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