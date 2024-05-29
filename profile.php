<?php
session_start();
include("dataconnection.php");

if (isset($_SESSION['jobseeker_email'])) {
    $email = $_SESSION['jobseeker_email'];

    $query = $connect->prepare("SELECT ProfilePic, PersonalSummary, Skills, work_experience, Education, language FROM userprofile WHERE jobseeker_email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $query->store_result();
    $query->bind_result($profilePic, $personalSummary, $skills, $workExperience, $education, $language);
    $query->fetch();

} else {
    echo "Session email not set.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        header {
            background-color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ccc;
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
            font-family: Arial, sans-serif; 
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
            font-family: Arial, sans-serif; 
        }

        .employer-site:hover { 
            background-color: blue;
        }

        .employer-site:hover a { 
            color: white;
        }

        .container {
            max-width: 1200px;
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
            font-family: Arial, sans-serif; 
            font-size: 18px; 
        }

        .form-group {
            margin-bottom: 20px;
            position: relative; 
            margin-left: 13%; 
            height: 250px;
            weight: 250px;
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
            font-family: Arial, sans-serif; 
            transition: background-color 0.3s, color 0.3s; 
            margin-left: 10px;
        }

        .add-skill-btn:hover,
        .select-language-btn:hover {
            background-color: darkblue; 
            color: white; 
        }

        .edit-icon {
            position: absolute;
            margin-right: 320px;
            margin-top: 100px;
            font-size: 20px;
            color: #999; 
            cursor: pointer;
            right: 10px; 
            top: 10px;
        }

        .edit-icon:hover::after {
            content: "";
            width: 30px;
            height: 30px;
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1; 
        }

        .section-title {
            font-size: 24px;
            margin-bottom: 10px;
            margin-left: 20px;
        }

        body {
            font-family: Arial, sans-serif; 
        }

        .icon {
            margin-right: 120px;
        }

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
            width: 40%; 
            height: 100%;
            position: fixed;
            top: 0;
            right: 0;
            background-color: #fff;
            z-index: 999; 
            overflow-y: auto; 
            padding: 20px;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1); 
        }

        .profile-picture-container {
            text-align: center;
            margin-bottom: 20px;
        }

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

        .upload-icon:hover {
            background-color: #eee;
        }

        #languageSelectForm {
            display: none;
            position: fixed;
            top: 0;
            right: 0;
            width: 40%; 
            height: 100%;
            background-color: #fff;
            z-index: 999; 
            overflow-y: auto; 
            padding: 20px;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1); 
            animation: slideFromRight 0.5s ease forwards;
        }

        
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
            margin-left: 10px; 
            margin-bottom: 10px; 
            background-color: white;
            text-decoration: none;
            color: blue;
            font-family: Arial, sans-serif;
        }

        .display-box {
            position: relative;
            width: 70%;
            height: 200px;
            padding: 10px;
            border: 1px solid black;
            border-radius: 5px;
            margin-top: 5px;
            font-family: Arial, sans-serif;
            font-size: 16px;
        }

        input[type="text"], textarea {
            width: 100%;
            height: 200px; 
            padding: 10px;
            font-size: 18px; 
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        textarea {
            height: 100px; 
        }
        .upload-icon {
            position: relative;
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

        .upload-icon:hover {
            background-color: #eee;
        }
        footer {
            background-color: white;
            padding: 10px 20px;
            position: fixed;
            bottom: 0;
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
            <img src="logo.png" alt="Company Logo">
        </div>

        <nav class="navigation">
            <ul>
                <li><a href="jobsave.php?email=<?php echo urlencode($_SESSION['jobseeker_email']); ?>">Job Save</a></li>
                <li><a href="profile.php?email=<?php echo urlencode($_SESSION['jobseeker_email']); ?>">Profile</a></li>
                <li><a href="#">Company Profile</a></li>
            </ul>
        </nav>

        <div class="employer-site">
            <a href="#">Employer Site</a>
        </div>
    </header>


    <div class="container">
    <h2>Upload Profile Picture</h2>
    <form action="upload_profile_picture.php" method="POST" enctype="multipart/form-data">
        <div class="profile-picture-container">
            <input type="file" id="profilePictureInput" name="profile_picture" accept="image/*" onchange="displayProfilePicture(event)">
            <label for="profilePictureInput">
                <?php if ($profilePic) { ?>
                    <img src="<?php echo $profilePic; ?>" alt="Profile Picture" id="profilePicture">
                <?php } else { ?>
                    <img src="default_profile_picture.png" alt="Profile Picture" id="profilePicture">
                <?php } ?>
                <span class="upload-icon"><i class="fas fa-upload"></i></span>
            </label>
        </div>
        <button type="submit" class="add-skill-btn">Upload</button>
    </form>
</div>

<div class="profile-info">
    <div class="form-group">
        <h1 class="section-title">Personal Summary</h1>
        <div id="personalSummaryDisplay" class="display-box"><?php echo $personalSummary; ?></div>
        <span class="edit-icon" onclick="toggleEditForm('editPersonalSummaryForm')">&#9998;</span>
    </div>

    <div id="editPersonalSummaryForm" style="display: none;" class="slide-from-right">
        <form onsubmit="return savePersonalSummary()">
            <h1>Edit Personal Summary</h1>
            <input type="text" id="editedPersonalSummary" name="editedPersonalSummary" value="<?php echo $personalSummary; ?>" placeholder="Enter your personal summary">
            <div>
                <button type="submit" class="add-skill-btn">Save Personal Summary</button>
                <button type="button" class="add-skill-btn" onclick="toggleEditForm('editPersonalSummaryForm')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<div class="form-group">
    <h1 class="section-title">Skills</h1>
    <div id="SkillsDisplay" class="display-box"><?php echo $skills; ?></div>
    <span class="edit-icon" onclick="toggleEditForm('editSkillsFormContainer')">&#9998;</span>
</div>

<div id="editSkillsFormContainer" style="display: none;" class="slide-from-right">
    <form id="editSkillsForm" onsubmit="return saveSkills()">
        <h1>Edit Skills</h1>
        <input type="text" id="editedSkills" name="editedSkills" value="<?php echo $skills; ?>" placeholder="Enter your skills">
        <div>
            <button type="submit" name="submit" class="add-skill-btn">Save skills</button>
            <button type="button" class="add-skill-btn" onclick="toggleEditForm('editSkillsFormContainer')">Cancel</button>
        </div>
    </form>
</div>

<div class="form-group">
    <h1 class="section-title">Education</h1>
    <div id="educationDisplay" class="display-box"><?php echo $education; ?></div>
    <span class="edit-icon" onclick="toggleEditForm('editEducationForm')">&#9998;</span>
</div>

<div id="editEducationForm" style="display: none;" class="slide-from-right">
    <form id="editEducationWorkForm" onsubmit="return saveEducation()">
        <h1>Edit Education</h1>
        <input type="text" id="editedEducation" name="editedEducation" value="<?php echo $education; ?>" placeholder="Enter your education">
        <div>
            <button type="submit" name="submit" class="add-skill-btn">Save Education</button>
            <button type="button" class="add-skill-btn" onclick="toggleEditForm('editEducationForm')">Cancel</button>
        </div>
    </form>
</div>

<div class="form-group">
    <h1 class="section-title">Work Experience</h1>
    <div id="workExperienceDisplay" class="display-box"><?php echo $workExperience; ?></div>
    <span class="edit-icon" onclick="toggleEditForm('editWorkExperienceForm')">&#9998;</span>
</div>

<div id="editWorkExperienceForm" style="display: none;" class="slide-from-right">
    <form id="editWorkExperienceForm" onsubmit="return saveWorkExperience()">
        <h1>Edit Work Experience</h1>
        <input type="text" id="editedWorkExperience" name="editedWorkExperience" value="<?php echo $workExperience; ?>" placeholder="Enter your work experience">
        <div>
            <button type="submit" name="submit" class="add-skill-btn">Save Workexperience</button>
            <button type="button" class="add-skill-btn" onclick="toggleEditForm('editWorkExperienceForm')">Cancel</button>
        </div>
    </form>
</div>

<div class="form-group">
        <h1 class="section-title">Language</h1>
        <div id="selectedLanguageBox" class="language-box">
            <?php echo '<div>' . $language . '</div>'; ?>
        </div>
        <button class="add-skill-btn" onclick="toggleLanguageSelectForm()">Add Language</button> <!-- Moved button here -->
    </div>
</div>
    <form id="languageSelectForm" style="display: none;">
        <input type="text" id="languageSearch" onkeyup="filterLanguages()" placeholder="Search for a language...">
        <select id="languageSelect" multiple>
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
        </select>
        <button type="button" onclick="toggleLanguageSelectForm()">Cancel</button>
        <button type="button" onclick="saveLanguage()">Save</button>
    </form>
</div>

<script>
      
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
    
          
        ];

        function showLanguageOptions() {
            const languageSelect = document.getElementById('languageSelect');

            
            languageSelect.innerHTML = '';

            
            languages.forEach(language => {
                const option = document.createElement('option');
                option.text = language;
                languageSelect.add(option);
            });

            languageSelect.style.display = 'block';
        }
       
        function saveLanguage() {
    const select = document.getElementById('languageSelect');
    const selectedLanguages = [];
    for (let i = 0; i < select.options.length; i++) {
        if (select.options[i].selected) {
            selectedLanguages.push(select.options[i].value);
        }
    }

    const formData = new FormData();
    formData.append('language', JSON.stringify(selectedLanguages)); 
    formData.append('email', "<?php echo $email; ?>");

    fetch('save_language.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            console.log('Language added successfully.');
        } else {
            console.error('Error adding language.');
        }
    })
    .catch(error => {
        console.error('Error adding language:', error);
    });

  
    const languageBox = document.getElementById('selectedLanguageBox');
    languageBox.innerHTML = ''; 
    selectedLanguages.forEach(language => {
        const languageElement = document.createElement('div');
        languageElement.textContent = language;
        languageBox.appendChild(languageElement);
    });

    
    languageBox.style.display = 'block';

    toggleLanguageSelectForm();
}
function filterLanguages() {
    var input = document.getElementById('languageSearch');
    var filter = input.value.toLowerCase();
    var options = document.getElementById('languageSelect').options;

    for (var i = 0; i < options.length; i++) {
        var txtValue = options[i].textContent || options[i].innerText;
        if (txtValue.toLowerCase().indexOf(filter) > -1) {
            options[i].style.display = '';
        } else {
            options[i].style.display = 'none';
        }
    }
}

function toggleLanguageSelectForm() {
    var form = document.getElementById('languageSelectForm');
    form.style.display = form.style.display === 'block' ? 'none' : 'block';
}

        
        function toggleEditForm() {
            var editForm = document.querySelector('.edit-form');
            if (editForm.style.display === 'none' || editForm.style.display === '') {
                editForm.style.display = 'block';
            } else {
                editForm.style.display = 'none';
            }
        }

function savePersonalSummary() {
    const editedSummary = document.getElementById('editedPersonalSummary').value;
    document.getElementById('personalSummaryDisplay').value = editedSummary;
    toggleEditForm('editPersonalSummaryForm');

    const email = "<?php echo $email; ?>";
    const formData = new FormData();
    formData.append('personal_summary', editedSummary);
    formData.append('email', email);

    fetch('save_personal_summary.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            console.log('Personal summary saved successfully.');
        } else {
            console.error('Error saving personal summary.');
        }
    })
    .catch(error => {
        console.error('Error saving personal summary:', error);
    });

    return false;
}

function saveEducation() {
    const editedEducation = document.getElementById('editedEducation').value;
    document.getElementById('educationDisplay').value = editedEducation;
    toggleEditForm('editEducationForm');

    const email = "<?php echo $email; ?>";
    const formData = new FormData();
    formData.append('education', editedEducation);
    formData.append('email', email);

    fetch('save_education.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            console.log('Education saved successfully.');
        } else {
            console.error('Error saving education.');
        }
    })
    .catch(error => {
        console.error('Error saving education:', error);
    });

    return false;
}

function saveSkills() {
    const editedSkills = document.getElementById('editedSkills').value;
    document.getElementById('SkillsDisplay').value = editedSkills;
    toggleEditForm('editSkillsFormContainer');

    const email = "<?php echo $email; ?>";
    const formData = new FormData();
    formData.append('skills', editedSkills);
    formData.append('email', email);

    fetch('save_skills.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            console.log('Skills saved successfully.');
        } else {
            console.error('Error saving skills.');
        }
    })
    .catch(error => {
        console.error('Error saving skills:', error);
    });

    return false;
}

function saveWorkExperience() {
    const editedWorkExperience = document.getElementById('editedWorkExperience').value;
    document.getElementById('workExperienceDisplay').value = editedWorkExperience;
    toggleEditForm('editWorkExperienceForm');

    const email = "<?php echo $email; ?>";
    const formData = new FormData();
    formData.append('work_experience', editedWorkExperience);
    formData.append('email', email);

    fetch('save_work_experience.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            console.log('Work experience saved successfully.');
        } else {
            console.error('Error saving work experience.');
        }
    })
    .catch(error => {
        console.error('Error saving work experience:', error);
    });

    return false;
}

    document.addEventListener("DOMContentLoaded", function() {
        fetchLanguages();
    });

   
    event.preventDefault();
            const formData = new FormData(this);

            fetch('upload_resume.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    console.log('Resume uploaded successfully.');
                } else {
                    console.error('Error uploading resume.');
                }
            })
            .catch(error => {
                console.error('Error uploading resume:', error);
            });
            function toggleEditForm(formId) {
    var editForm = document.getElementById(formId);
    if (editForm.style.display === 'none' || editForm.style.display === '') {
        editForm.style.display = 'block';
    } else {
        editForm.style.display = 'none';
    }
}
        
    </script>
    <footer>
        <nav>
            <ul>
                <li><a href="aboutus.html">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="homepage.php">Homepage</a></li>

            </ul>
        </nav>
    </footer>
</body>
</html>

