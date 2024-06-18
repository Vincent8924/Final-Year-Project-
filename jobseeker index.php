<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiring With Us!</title>
    <link rel="stylesheet" type="text/css" href="jobseeker index.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
   
</head>
<body>
    <header class="header">
        <img src="general_image/jobhelper_logo.png" class="logo">
        <div>
            <a href="register.php">Register</a>
            <a href="login.php">Log In</a>
        </div>
    </header>
    
    <div id="slideshow" class="index_container" >
        <img src="lo.jpg" class="active">
        <img src="gc.jpg">
        <img src="vt.jpg">
        <div class="text">
            Welcome to Job Helper!
            <a href="login.php" class="button">Get Start Now!</a></div></div>
        </div>

    </div>
     
    <div class="Acontainer">
        <div class="Bcontainer">
            1
            <br>
            <h3>
                Create your
                <br>
                free account
            </h3>
            <br>
            You will need to fill in some information for register an own account!
        </div>
        <div class="Bcontainer">
            2
            <br>
            <h3>
                finding your favourite
                <br>
                job post
            </h3>
            <br>
            find the favourite job at the homepage and apply it!
        </div>
        <div class="Bcontainer">
            3
            <br>
            <h3>
                
               wait for the result
            </h3>
            <br>
            after apply,you just need to wait for the result for the company
        </div>
    </div>

    <footer>
        <h2 class="title">Job Helper&trade;</h2>
        <p class="slogan">Your right choice for hiring talent!</p>
    </footer>

    
</body>
</html>
<script>
    $(function() {
        var texts = $("#wel_slider p");

        var currentIndex = 0;

        setInterval(function() {
            texts.eq(currentIndex).removeClass("active");
            currentIndex = (currentIndex + 1) % texts.length;
            texts.eq(currentIndex).addClass("active");
        }, 3000);
    });

    $(function() {
        var images = $(".index_container img"); 

        var currentIndex = 0; 

        setInterval(function() {
            images.eq(currentIndex).removeClass("active"); 

            currentIndex = (currentIndex + 1) % images.length; 

            images.eq(currentIndex).addClass("active"); 
        }, 3000); 
    }); 
</script>
