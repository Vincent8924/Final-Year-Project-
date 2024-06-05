<?php
include("dataconnection.php");
include("Jsession.php");

if (!$connect) {
    die("Database connection failed: " . mysqli_connect_error());
}

$firstName = '';

if (isset($_SESSION['id'])) 
    $id = $_SESSION['id'];
    $id = $connect->real_escape_string($id);

    $query = "SELECT jobseeker_firstname FROM jobseeker WHERE jobseeker_id = '$id'";
    $result = $connect->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row['jobseeker_firstname'];
    }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $subject = mysqli_real_escape_string($connect, $_POST['subject']);
    $message = mysqli_real_escape_string($connect, $_POST['message']);

    $checkQuery = "SELECT * FROM jobseeker WHERE jobseeker_email = '$email'";
    $result = mysqli_query($connect, $checkQuery);

    if ($result && mysqli_num_rows($result) > 0) {
        $insertQuery = "INSERT INTO contact (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
        if (mysqli_query($connect, $insertQuery)) {
            echo '<script>alert("Comment submitted successfully!");</script>';
        } else {
            echo '<script>alert("Error: ' . mysqli_error($connect) . '");</script>';
        }
    } else {
        echo '<script>alert("Cannot submit the form. Please register an account first.");</script>';
    }

    mysqli_free_result($result);

    $firstName = '';

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        
       
        header {
            background-color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navigation {
            display: inline-block;
            margin-right: 50%;
        }

        .navigation ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .navigation ul li {
            display: inline-block;
            margin-right: 20px;
        }

        .navigation ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            transition: color 0.3s;
        }

        .navigation ul li a:hover {
            color: #555;
        }
   
        .employer-site {
            display: inline-block;
            padding: 8px 16px;
            border: 2px solid blue; 
            border-radius: 5px; 
        }

  
        .employer-site a {
            text-decoration: none;
            color: rgb(12, 12, 191); 
        }

     
        .employer-site:hover {
            background-color: blue; 
        }

      
        .employer-site:hover a {
            color: white; 
        }

        .logo {
            display: inline-block;
        }

        .logo img {
            height: 50px; 
        }

        .navigation {
            display: inline-block;
            margin-left: 20px; 
        }

        .navigation ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .navigation ul li {
            display: inline-block;
            margin-right: 20px;
        }

        

        .employer-site {
            display: inline-block;
            padding: 8px 16px;
            border: 2px solid blue;
            border-radius: 5px;
            margin-left: 20px;
        }

        .employer-site a {
            text-decoration: none;
            color: rgb(12, 12, 191);
        }

        .employer-site:hover {
            background-color: blue;
        }

        .employer-site:hover a {
            color: white;
        }

        .user-info {
            display: inline-block;
            padding: 8px 16px;
            border: 2px solid green;
            border-radius: 5px;
            margin-left: 50px;
        }

        .user-info p {
            margin: 0;
            font-weight: bold;
            color: green;
        }

        .user-info:hover {
            background-color: green;
        }

        .user-info:hover p {
            color: white;
        }



        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden; 
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .contact-info, .business-hours, .message-form, .address-map {
            margin-bottom: 30px;
        }
        .contact-info p {
            margin: 10px 0;
            color: #555;
        }
        .message-form input[type="text"],
        .message-form input[type="email"],
        .message-form input[type="subject"],
        .message-form textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 30px; 
            outline: none;
        }
        .message-form textarea {
    width: calc(100% - 22px);
    height: 300px;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #000; 
    border-radius: 30px;
    outline: none;
}
        .message-form button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .message-form button:hover {
            background-color: #0056b3;
        }
        .address-map img {
            width: 100%;
            border: none; 
        }
        footer {
    background-color: white;
    padding: 10px 20px;
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    box-shadow: 0px -1px 10px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: center;
    align-items: center;
}

footer nav ul {
    font-family: 'Times New Roman', Times, serif;
    list-style-type: none;
    padding: 0;
    margin: 0;
    display: flex;
    gap: 20px;
    justify-content: center;
    align-items: center;
}

footer nav ul li a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    transition: color 0.3s;
}

footer nav ul li a:hover {
    color: #555;
}
    </style>
</head>
<body>


<header>
    <div class="logo">
        <img src="new.jpg" alt="Company Logo">
    </div>

    <nav class="navigation">
        <ul>
        <li><a href="homepage.php?email=<?php echo urlencode($_SESSION['id']); ?>">Job search</a></li>
        <li><a href="profile.php?email=<?php echo urlencode($_SESSION['id']); ?>">Profile</a></li>
        </ul>
    </nav>
    
    <div class="user-info" id="logoutBtn">
    <?php
    if (isset($firstName)) {
        echo '<p>Welcome, ' . $firstName . '</p>';
    }
    ?>
</div>
  

    <div class="employer-site">
            <a href="employer sign up.php">Employer Site</a>
        </div>
    </div>
</header>

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
        
        <img src="melaka.jpg" alt="Location Map">
    </div>

    <div class="message-form">
    <h3>Send Us a Message</h3>
    <form class="contactForm" method="post" onsubmit="return validateForm()">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <input type="text" name="subject" placeholder="Subject" required>
        <textarea name="message" placeholder="Your Message" required></textarea>
        <button type="submit">Submit</button>
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
        <li><a href="aboutus.php?email=<?php echo urlencode($_SESSION['id']); ?>">About us</a></li>
        <li><a href="contact.php?email=<?php echo urlencode($_SESSION['id']); ?>">Contact us</a></li>
        <li><a href="applylist.php?email=<?php echo urlencode($_SESSION['id']); ?>">Apply list</a></li>
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
</script>

</body>
</html>