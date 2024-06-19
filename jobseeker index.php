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

<header>
        <div class="logo">
        <img src="../Final-Year-Project-/general_image/jobhelper_logo.png" alt="JobStreet Logo">
        </div>
        <nav class="navigation">
            <ul>
            <li><a href="homepage.php?email=<?php echo urlencode($_SESSION['id']); ?>">Homepage</a></li>  
                <li><a href="jobsave.php?email=<?php echo urlencode($_SESSION['id']); ?>">Job Save</a></li>
                <li><a href="profile.php?email=<?php echo urlencode($_SESSION['id']); ?>">Profile</a></li>
                <li><a href="applylist.php?email=<?php echo urlencode($_SESSION['id']); ?>">Apply list</a></li>
   
   
            </ul>
        </nav>
        </div>

        <div class="employer-site">
            <a href="employer sign up.php">Employer Site</a>
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
                Create Your
                <br>
                Free Account
            </h3>
            <br>
            You will need to fill in some information to register your own account!
        </div>
        <div class="Bcontainer">
            2
            <br>
            <h3>
                Build
                <br>
                Your Profile
            </h3>
            <br>
            Complete your profile and upload your resume!
        </div>
        <div class="Bcontainer">
            3
            <br>
            <h3>
                Find Your 
                <br>
                Favourite Job
            </h3>
            <br>
            Find your favorite job and apply for it!
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
