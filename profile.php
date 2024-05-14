<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobstreet";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$firstName = "";
$lastName = "";
$email = "";

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    $query = $conn->prepare("SELECT jobseeker_firstname, jobseeker_lastname FROM jobseeker WHERE jobseeker_email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $query->store_result();
    
    if ($query->num_rows > 0) {
        $query->bind_result($firstName, $lastName);
        $query->fetch();
    }
}

if (isset($_POST['submit'])) {
    $personalSummary = $_POST['personal_summary'] ?? '';
    $education = $_POST['education'] ?? '';
    $skills = $_POST['skills'] ?? '';
    $workExperience = $_POST['work_experience'] ?? '';

    if (!empty($personalSummary)) {
        $updateQuery = $conn->prepare("UPDATE userprofile SET PersonalSummary = ? WHERE Email = ?");
        $updateQuery->bind_param("ss", $personalSummary, $email);
        if ($updateQuery->execute()) {
            echo "Personal summary saved successfully.";
        } else {
            echo "Error saving personal summary.";
        }
    }
    if (!empty($education)) {
        $updateQuery = $conn->prepare("UPDATE userprofile SET Education = ? WHERE Email = ?");
        $updateQuery->bind_param("ss", $education, $email);
        if ($updateQuery->execute()) {
            echo "Education saved successfully.";
        } else {
            echo "Error saving education.";
        }
    }
    if (!empty($skills)) {
        $updateQuery = $conn->prepare("UPDATE userprofile SET Skill = ? WHERE Email = ?");
        $updateQuery->bind_param("ss", $skills, $email);
        if ($updateQuery->execute()) {
            echo "Skills saved successfully.";
        } else {
            echo "Error saving skills.";
        }
    }
    if (!empty($workExperience)) {
        $updateQuery = $conn->prepare("UPDATE userprofile SET WorkExperience = ? WHERE Email = ?");
        $updateQuery->bind_param("ss", $workExperience, $email);
        if ($updateQuery->execute()) {
            echo "Work experience saved successfully.";
        } else {
            echo "Error saving work experience.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <!-- Add Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Your CSS styles */
        /* Header styles */
        header {
            background-color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ccc; /* Add underline to the header */
        }

        .logo {
            display: inline-block;
        }

        .logo img {
            height: 50px;
        }

        .navigation {
            display: inline-block;
            margin-right: 60%;
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
            font-family: Arial, sans-serif; /* Change font style to Arial */
        }

        .navigation ul li a:hover {
            color: #555;
        }

        .employer-site { 
            display: inline-block;
            padding: 8px 16px;
            border: 2px solid blue;
            border-radius: 5px;
            margin-left: 20px; 
            background-color: white;
        }

        .employer-site a { 
            text-decoration: none;
            color: blue;
            font-family: Arial, sans-serif; /* Change font style to Arial */
        }

        .employer-site:hover { 
            background-color: blue;
        }

        .employer-site:hover a { 
            color: white;
        }

        .container {
            max-width: 1200px; /* Increased max-width for the container */
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .profile-info {
            margin-bottom: 20px;
        }

        .profile-info p {
            margin: 5px 0;
            font-family: Arial, sans-serif; /* Change font style to Arial */
            font-size: 18px; /* Increase font size */
        }

        .form-group {
            margin-bottom: 20px;
            position: relative; /* Add relative positioning */
            margin-left: 13%; /* Move the form group to the right */
        }

        input[type="text"],
        textarea {
            width: 70%;
            height: 180px;
            padding: 12px 12px 12px 30px; /* Adjust padding */
            border: 1px solid #ccc;
            border-radius: 20px; /* Rounded rectangle */
            box-sizing: border-box;
            margin-top: 5px;
            font-family: Arial, sans-serif; /* Change font style to Arial */
            font-size: 16px; /* Increase font size */
            position: relative; /* Add relative positioning */
        }

        .add-skill-btn,
        .select-language-btn {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-family: Arial, sans-serif; /* Change font style to Arial */
            transition: background-color 0.3s, color 0.3s; /* Add transition effect for both background and color */
            margin-left: 10px;
        }

        .add-skill-btn:hover,
        .select-language-btn:hover {
            background-color: darkblue; /* Change background color on hover */
            color: white; /* Change text color on hover */
        }

        .edit-icon {
            font-size: 20px;
            color: #999; /* Change pen icon color to grey */
            cursor: pointer;
            right: 10px; /* Adjust the position of the icon */
            top: 50%;
            transform: translateY(-50%);
        }

        /* Circle hover effect */
        .edit-icon:hover::after {
            content: "";
            width: 30px;
            height: 30px;
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1; /* Ensure the circle is behind the pen icon */
        }

        /* Increase font size for specific sections */
        .section-title {
            font-size: 24px;
            margin-bottom: 10px;
            margin-left: 20px; /* Adjust the left margin */
        }

        body {
            font-family: Arial, sans-serif; /* Change font style to Arial for the whole document */
        }

        /* Style for icon */
        .icon {
            margin-right: 120px;
        }

        /* Additional styles for sliding animation */
        @keyframes slideFromRight {
            0% {
                opacity: 0;
                transform: translateX(100%);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .slide-from-right {
            animation: slideFromRight 0.5s ease forwards;
            width: 40%; /* Adjust width to occupy 2/5 of the page */
            height: 100%;
            position: fixed;
            top: 0;
            right: 0;
            background-color: #fff;
            z-index: 999; /* Ensure it appears above other elements */
            overflow-y: auto; /* Allow scrolling if content exceeds height */
            padding: 20px;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1); /* Add box shadow */
        }

        /* CSS for profile picture container */
        .profile-picture-container {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Style for the circular container */
        .profile-picture-container input[type="file"] {
            display: none;
        }

        .profile-picture-container img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 2px solid #ccc;
            cursor: pointer;
        }

        /* Style for the upload icon */
        .upload-icon {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background-color: white;
            padding: 5px;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .upload-icon i {
            color: #555;
        }

        /* Hover effect for the upload icon */
        .upload-icon:hover {
            background-color: #eee;
        }

        #languageSelectForm {
            display: none;
            position: fixed;
            top: 0;
            right: 0;
            width: 40%; /* Adjust width to occupy 2/5 of the page */
            height: 100%;
            background-color: #fff;
            z-index: 999; /* Ensure it appears above other elements */
            overflow-y: auto; /* Allow scrolling if content exceeds height */
            padding: 20px;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1); /* Add box shadow */
            animation: slideFromRight 0.5s ease forwards;
        }

        /* Animation for sliding from right to left */
        @keyframes slideFromRight {
            0% {
                opacity: 0;
                transform: translateX(100%);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        #languageSelectForm {
    padding-top: 10px;
    border-top: 1px solid #ccc;
}

#languageSearch {
    width: 100%;
    padding: 10px;
    margin-top: 20px;
    margin-right: 80px;
    border: 1px solid black;
    border-radius: 5px;
    height: 25px;
}
#languageSelect {
    width: 100%;
    height: 150px;
    padding: 5px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-family: Arial, sans-serif;
}

#languageSelect option {
    padding: 5px;
}

/* Hide the dropdown arrow for select box */
#languageSelect::-ms-expand {
    display: none;
}
.language-box {
    display: flex;
    flex-wrap: wrap;
    margin-top: 10px;
    margin-bottom: 20px;
}

.language-box div {
    display: inline-block;
    padding: 8px 16px;
    border: 2px solid blue;
    border-radius: 5px;
    margin-left: 10px; /* Adjust margin */
    margin-bottom: 10px; /* Adjust margin */
    background-color: white;
    text-decoration: none;
    color: blue;
    font-family: Arial, sans-serif;
}

    </style>
</head>
<body>
   
    <header>
        <div class="logo">
            <img src="logo.png" alt="Company Logo">
        </div>

        <nav class="navigation">
            <ul>
                <li><a href="jobsave.php?email=<?php echo urlencode($_SESSION['email']); ?>">Job Save</a></li>
                <li><a href="profile.php?email=<?php echo urlencode($_SESSION['email']); ?>">Profile</a></li>
                <li><a href="#">Company Profile</a></li>
            </ul>
        </nav>

        <div class="employer-site">
            <a href="#">Employer Site</a>
        </div>
    </header>

    <div class="container">
        <div class="profile-info">
            <h1>Jobseeker Profile</h1>
            <p>
                <i class="icon fas fa-user"></i> <!-- Icon for name -->
                <strong>:</strong> <?php echo $firstName . ' ' . $lastName; ?>
            </p>
            <p>
                <i class="icon fas fa-envelope"></i> <!-- Icon for email -->
                <strong>:</strong> <?php echo $email; ?>
            </p>
        </div>
    </div>

    <!-- Profile Picture Upload Section -->
    <div class="container">
        <h2>Upload Profile Picture</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="profile-picture-container">
                <input type="file" id="profilePictureInput" name="profile_picture" accept="image/*" onchange="displayProfilePicture(event)">
                <label for="profilePictureInput">
                    <img src="default_profile_picture.png" alt="Profile Picture" id="profilePicture">
                    <span class="upload-icon"><i class="fas fa-upload"></i></span>
                </label>
            </div>
            <button type="submit">Upload</button>
        </form>
    </div>
    <!-- End of Profile Picture Upload Section -->

    <!-- Removed containers, keeping content intact -->

    <div class="profile-info">
    <div class="form-group">
        <h1 class="section-title">Personal Summary</h1>
        <div style="position: relative;">
            <textarea id="personalSummaryDisplay" name="Personal Summary" readonly></textarea>
            <span class="edit-icon" onclick="toggleEditForm('editPersonalSummaryForm')">&#9998;</span>
            <input name="name" type="text"  >
        </div>
    </div>

    <div id="editPersonalSummaryForm" style="display: none;" class="slide-from-right">
        <form id="editForm" onsubmit="return savePersonalSummary()">
            <h1>Edit Personal Summary</h1>
            <input type="text" id="editedPersonalSummary" name="editedPersonalSummary" placeholder="Enter your personal summary">
            <div>
            <button type="submit" name="submit" class="add-skill-btn">Save</butto>
                <button type="button" class="add-skill-btn" onclick="toggleEditForm('editPersonalSummaryForm')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<div class="form-group">
    <h1 class="section-title">Skills</h1>
    <input type="text" id="skillsDisplay" name="skills">
    <span class="edit-icon" onclick="toggleEditForm('editSkillsFormContainer')">&#9998;</span>
</div>

<div id="editSkillsFormContainer" style="display: none;" class="slide-from-right">
    <form id="editSkillsForm" onsubmit="return saveSkills()">
        <h1>Edit Skills</h1>
        <input type="text" id="editedSkills" name="editedSkills" placeholder="Enter your skills" >
        <div>
        <button type="submit" name="submit" class="add-skill-btn">Save</button>
            <button type="button" class="add-skill-btn" onclick="toggleEditForm('editSkillsFormContainer')">Cancel</button>
        </div>
    </form>
</div>
      <!-- Education Form -->
<div class="form-group">
    <h1 class="section-title">Education</h1>
    <input type="text" id="educationDisplay" name="education" >
    <span class="edit-icon" onclick="toggleEditForm('editEducationForm')">&#9998;</span>
</div>

<div id="editEducationForm" style="display: none;" class="slide-from-right">
    <form id="editEducationWorkForm" onsubmit="return saveEducation()">
        <h1>Edit Education</h1>
        <input type="text" id="editedEducation" name="editedEducation" placeholder="Enter your education">
        <div>
        <button type="submit" name="submit" class="add-skill-btn">Save</button>
            <button type="button" class="add-skill-btn" onclick="toggleEditForm('editEducationForm')">Cancel</button>
        </div>
    </form>
</div>

<!-- Work Experience Form -->
<div class="form-group">
    <h1 class="section-title">Work Experience</h1>
    <input type="text" id="workExperienceDisplay" name="workExperience" >
    <span class="edit-icon" onclick="toggleEditForm('editWorkExperienceForm')">&#9998;</span>
</div>

<div id="editWorkExperienceForm" style="display: none;" class="slide-from-right">
    <form id="editWorkExperienceForm" onsubmit="return saveWorkExperience()">
        <h1>Edit Work Experience</h1>
        <input type="text" id="editedWorkExperience" name="editedWorkExperience" placeholder="Enter your work experience">
        <div>
        <button type="submit" name="submit" class="add-skill-btn">Save</button>
            <button type="button" class="add-skill-btn" onclick="toggleEditForm('editWorkExperienceForm')">Cancel</button>
        </div>
    </form>
</div>

    
        <div class="form-group">
    <h1 class="section-title">Language</h1>
    <!-- Language display box -->
    <div id="selectedLanguageBox" class="language-box" style="display: none;"></div>
    <button class="add-skill-btn" onclick="toggleLanguageSelectForm()">Add Language</button>
    <!-- Language select form -->
    <form id="languageSelectForm">
        <input type="text" id="languageSearch" onkeyup="filterLanguages()" placeholder="Search for a language...">
        <select id="languageSelect" multiple>
            <!-- Language options will be dynamically added here -->
            <option value="English">English</option>
            <option value="Spanish">Spanish</option>
            <option value="French">French</option>
            <option value="German">German</option>
            <option value="Chinese">Chinese</option>
            <option value="Arabic">Arabic</option>
            <option value="Russian">Russian</option>
            <option value="Portuguese">Portuguese</option>
            <option value="Italian">Italian</option>
            <option value="Japanese">Japanese</option>
            <option value="Korean">Korean</option>
            <option value="Dutch">Dutch</option>
            <option value="Swedish">Swedish</option>
            <!-- Add more options as needed -->
        </select>
        <button type="button" onclick="toggleLanguageSelectForm()">Cancel</button>
        <button type="button" onclick="saveLanguage()">Save</button>
    </form>
</div>
    </div>



    <script>
        // JavaScript to handle the functionality

        // Array of world languages
        const languages = [
            "English",
    "Spanish",
    "French",
    "German",
    "Chinese",
    "Arabic",
    "Russian",
    "Portuguese",
    "Italian",
    "Japanese",
    "Korean",
    "Dutch",
    "Swedish",
    "Danish",
    "Norwegian",
    "Finnish",
    "Greek",
    "Turkish",
    "Polish",
    
            // Add more languages as needed
        ];

        // Function to dynamically generate and display language options
        function showLanguageOptions() {
            const languageSelect = document.getElementById('languageSelect');

            // Clear previous options
            languageSelect.innerHTML = '';

            // Generate options for each language in the array
            languages.forEach(language => {
                const option = document.createElement('option');
                option.text = language;
                languageSelect.add(option);
            });

            // Display the select dropdown
            languageSelect.style.display = 'block';
        }
        // Function to save selected language(s)
// Function to save selected language(s)
function saveLanguage() {
    const select = document.getElementById('languageSelect');
    const selectedLanguages = [];
    for (let i = 0; i < select.options.length; i++) {
        if (select.options[i].selected) {
            selectedLanguages.push(select.options[i].value);
        }
    }
    // Append selected languages to the existing content in the languageBox div
    const languageBox = document.getElementById('selectedLanguageBox');
    selectedLanguages.forEach(language => {
        const languageElement = document.createElement('div');
        languageElement.textContent = language;
        languageBox.appendChild(languageElement);
    });
    // Show the language box
    languageBox.style.display = 'block';
    // Hide the language select form
    toggleLanguageSelectForm();
}

        /// Function to toggle edit form visibility
        function toggleEditForm() {
            var editForm = document.querySelector('.edit-form');
            if (editForm.style.display === 'none' || editForm.style.display === '') {
                editForm.style.display = 'block';
            } else {
                editForm.style.display = 'none';
            }
        }


        // Function to save the edited personal summary
        function savePersonalSummary() {
            const editedSummary = document.getElementById('editedPersonalSummary').value;
            document.getElementById('personalSummaryDisplay').value = editedSummary;
            toggleEditForm('editPersonalSummaryForm');
            return false; // To prevent form submission
        }

         // Function to toggle the visibility of the edit form with sliding animation
    function toggleEditForm(formId) {
        const form = document.getElementById(formId);
        if (form.style.display === 'none' || form.style.display === '') {
            form.classList.add('slide-from-right');
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }

    // Function to save the edited education
function saveEducation() {
    const editedEducation = document.getElementById('editedEducation').value;
    document.getElementById('educationDisplay').value = editedEducation;
    toggleEditForm('editEducationForm');
    return false; // To prevent form submission
}

// Function to save the edited work experience
function saveWorkExperience() {
    const editedWorkExperience = document.getElementById('editedWorkExperience').value;
    document.getElementById('workExperienceDisplay').value = editedWorkExperience;
    toggleEditForm('editWorkExperienceForm');
    return false; // To prevent form submission
}

// Function to save the edited skills
function saveSkills() {
    const editedSkills = document.getElementById('editedSkills').value;
    document.getElementById('skillsDisplay').value = editedSkills;
    toggleEditForm('editSkillsFormContainer');
    // You may also want to send the editedSkills to the server using AJAX if necessary
    return false; // To prevent form submission
}

        // Function to display selected profile picture
        function displayProfilePicture(event) {
            const input = event.target;
            const reader = new FileReader();

            reader.onload = function () {
                const img = document.getElementById('profilePicture');
                img.src = reader.result;
            };

            reader.readAsDataURL(input.files[0]);
        }

        function toggleLanguageSelectForm() {
            const form = document.getElementById('languageSelectForm');
            form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
        }

        // Function to display selected profile picture
        function displayProfilePicture(event) {
            const input = event.target;
            const reader = new FileReader();

            reader.onload = function () {
                const img = document.getElementById('profilePicture');
                img.src = reader.result;
            };

            reader.readAsDataURL(input.files[0]);
        }

        function filterLanguages() {
    const input = document.getElementById('languageSearch').value.toLowerCase();
    const options = document.getElementById('languageSelect').options;
    for (let i = 0; i < options.length; i++) {
        const text = options[i].text.toLowerCase();
        if (text.startsWith(input)) {
            options[i].style.display = '';
        } else {
            options[i].style.display = 'none';
        }
    }
}


    </script>
</body>
</html>