<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiring With Us!</title>
    <link rel="stylesheet" href="employer index.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="icon" href="general_image/jobhelper_logo.png">
</head>
<body>
    <header class="header">
        <img src="general_image/jobhelper_logo.png" class="logo">
        <div>
            <a href="employer sign up.php">Register</a>
            <a href="employer login.php">Log In</a>
            <a href="index.php">Jobseeker side</a>
        </div>
    </header>
    
    <div id="slideshow" class="index_container" >
        <img src="1.jpg" class="active">
        <img src="3.jpg">
        <img src="b.jpg">
        <div class="text">
            Welcome to Job Helper!
            <a href="employer login.php" class="button">Get Start Now!</a></div></div>
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
            All you need is your email address to create an account and start building your job post.
        </div>
        <div class="Bcontainer">
            2
            <br>
            <h3>
                Build your 
                <br>
                job post
            </h3>
            <br>
            Then just add a title, description, and location to your job post, and you're ready to go.
        </div>
        <div class="Bcontainer">
            3
            <br>
            <h3>
                Post your 
                <br>
                job
            </h3>
            <br>
            After you post your job use our state of the art tools to help you find dream talent.
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
