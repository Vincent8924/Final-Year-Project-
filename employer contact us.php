<?php
include("dataconnection.php");
include("employer session.php");


    $id = $_SESSION['id'];

    if(isset($_POST['logout'])) {
        session_destroy();
        echo'<script>alert("Log-Out successful!");window.location.href="employer login.php";</script>';
    }
    

if (isset($_POST['submit'])) {
    $name =  $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];


    $result = mysqli_query($connect, "SELECT * FROM jobseeker WHERE jobseeker_email = '$email'");

    if ($result && mysqli_num_rows($result) > 0) 
    {

       
        $success = mysqli_query($connect, "INSERT INTO contact (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')"); 
        
        if($success)
        {
            echo '<script>alert("Comment submitted successfully!");</script>';
        }
        else 
        {
            echo '<script>alert("Error: ' . mysqli_error($connect) . '");</script>';
        }
    } 
    else 
    {
        echo '<script>alert("Cannot submit the form. Please register an account first.");</script>';
    }


 

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="employer contact us.css">
 </head>
<body>


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
    <form method="post" >
       
            <button id="logout" name="logout" onclick='return userconfirmation();'><img src='img/logout.png' id="logout_photo">LOG OUT</button>
        </div> 
    </form>
</header>

<br/><br/><br/>

<div class="container">
    <h2>Contact Us</h2>
    
    <div class="contact-info">
        <p><i class="fas fa-map-marker-alt"></i> <strong>Address:</strong> Melaka Raya, Melaka, Malaysia</p>
        <p><i class="fas fa-phone-alt"></i> <strong>Phone:</strong> 60-1155164811</p>
        <p><i class="far fa-envelope"></i> <strong>Email:</strong> <a href="mailto:gohchenghong533@gmail.com">gohchenghong533@gmail.com</a></p>
    </div>

    <div class="business-hours">
        <h3>Business Hours</h3>
        <p><strong>Monday - Friday:</strong> [Opening Hours]</p>
        <p><strong>Saturday - Sunday:</strong> [Opening Hours]</p>
        <p>*Please note that we are closed on public holidays.</p>
    </div>

    <div class="address-map">
        <h3>Location</h3>
        
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7973.82971250458!2d102.25202053559836!3d2.1859772622551272!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d1ee1c87b4e103%3A0x40a3028e79c8f4c0!2sMelaka%20Raya%2C%2075000%20Malacca!5e0!3m2!1sen!2smy!4v1717972401813!5m2!1sen!2smy" width="800" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <div class="message-form">
    <h3>Send Us a Message</h3>
    <form class="contactForm" method="post" onsubmit="return validateForm()">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <input type="text" name="subject" placeholder="Subject" required>
        <textarea name="message" placeholder="Your Message" required></textarea>
        <button type="submit" name="submit">Submit</button>
    </form>
</div>


<script>
    document.getElementById("contactForm").addEventListener("submit", function(event) {
        event.preventDefault(); 

       
        alert("Your message has been successfully sent!");
        
    });
</script>
<footer>
        <nav>
            <ul>
                <li><a href="employer about us.php">About Us</a></li>
                <li><a href="employer contact us.php">Contact Us</a></li>
            </ul>
        </nav>
    </footer>
<script>
     document.getElementById('logoutBtn').addEventListener('click', function() {
        var confirmLogout = confirm('Are you sure you want to logout?');
        if (confirmLogout) {
            window.location.href = 'login.php';
        }
    });

    function userconfirmation()
        {
            answer = confirm("Do you want to log out?");
            return answer;
        }
</script>

</body>
</html>