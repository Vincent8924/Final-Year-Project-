<?php
include("Jsession.php");
include("dataconnection.php");

$id = $_SESSION['id'];
echo $id;


if (isset($_POST['ps'])) 
{
    $summary = $_POST['editedPersonalSummary'];

    mysqli_query($connect,"UPDATE userprofile SET PersonalSummary = '$summary' WHERE UserID = '$id'");
}

if (isset($_POST['add_skill'])) 
{
    $skill = $_POST['editedSkills'];

    mysqli_query($connect,"UPDATE userprofile SET Skills = '$skill' WHERE UserID = '$id'");
}

if (isset($_POST['add_education'])) 
{
    $education = $_POST['editedEducation'];

    mysqli_query($connect,"UPDATE userprofile SET Education = '$education' WHERE UserID = '$id'");
}

if (isset($_POST['add_ex'])) 
{
    $ex = $_POST['editedWorkExperience'];

    mysqli_query($connect,"UPDATE userprofile SET work_experience = '$ex' WHERE UserID = '$id'");
}




if (isset($_POST['add_lan'])) {
    if (isset($_POST['lan']) && is_array($_POST['lan'])) {
        $lan = implode(", ", $_POST['lan']);
        $lan = mysqli_real_escape_string($connect, $lan);
        mysqli_query($connect,"UPDATE userprofile SET `language` = '$lan' WHERE UserID = '$id'");
        
    } 
}




if (isset($_POST['add_pic'])) {
   
    $fileName = "profile_photo";
    $fileTmpName = $_FILES['photo']['tmp_name'];

    if(empty($fileTmpName))
    {
        

        $stmt = mysqli_prepare($connect, "UPDATE employer_profile SET `name` = ?,website = ?,industry = ?,company_size = ?,primary_location = ?,`description` = ? WHERE profile_id = '$id'");

        mysqli_stmt_bind_param($stmt, "ssssss", $name, $website,$industry,$size,$location,$des);
    }
    else
    {
        $pname = 'profile_photo';
        $fileData = file_get_contents($fileTmpName);
        $stmt = mysqli_prepare($connect, "UPDATE employer_profile SET `name` = ?,photo_name = ?,photo_data = ?,website = ?,industry = ?,company_size = ?,primary_location = ?,`description` = ? WHERE profile_id = '$id'");

        mysqli_stmt_bind_param($stmt, "ssssssss", $name, $pname, $fileData, $website,$industry,$size,$location,$des);
    }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="profile.css">
</head>
<body>

    <header>
        <div class="logo">
            <img src="logo.png" alt="Company Logo">
        </div>
        <nav class="navigation">
            <ul>
                <li><a href="jobsave.php">Job Save</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="#">Company Profile</a></li>
            </ul>
        </nav>
        <div class="employer-site">
            <a href="#">Employer Site</a>
        </div>
    </header>

    <?php
    $result = mysqli_query($connect, "SELECT * FROM userprofile WHERE UserID = '$id'");
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container">
        <h2>Upload Profile Picture</h2>
        <!--<form action="upload_profile_picture.php" method="post" enctype="multipart/form-data">-->

        <form method="post" enctype="multipart/form-data">
            <div class="profile-picture-container">
                <input type="file" id="profilePictureInput" name="profile_picture" accept="image/*" onchange="displayProfilePicture(event)">
                <label for="profilePictureInput">
                    <?php if ($row['ProfilePic'] != null) { ?>
                        <img src="<?php echo $row['ProfilePic']; ?>" alt="Profile Picture" id="profilePicture">
                    <?php } else { ?>
                        <img src="img/default.png" alt="Profile Picture" id="profilePicture">
                    <?php } ?>
                    <span class="upload-icon"><i class="fas fa-upload"></i></span>
                </label>
            </div>
            <button type="submit" name="add_pic" class="add-skill-btn">Upload</button>
        </form>
    </div>

    <div class="profile-info">
        <div class="form-group">
            <h1 class="section-title">Personal Summary</h1>
            <div id="personalSummaryDisplay" class="display-box"><?php echo $row['PersonalSummary']; ?></div>
            <span class="edit-icon" onclick="toggleEditForm('editPersonalSummaryForm')">&#9998;</span>
        </div>

        <div id="editPersonalSummaryForm" style="display: none;" class="slide-from-right">
            <form method="post">
                <h1>Edit Personal Summary</h1>
                <input type="text" id="editedPersonalSummary" name="editedPersonalSummary" value="<?php echo $row['PersonalSummary']; ?>" placeholder="Enter your personal summary">
                <div>
                    <button type="submit" name="ps" class="add-skill-btn">Save Personal Summary</button>
                    <button type="button" class="add-skill-btn" onclick="toggleEditForm('editPersonalSummaryForm')">Cancel</button>
                </div>
            </form>
        </div>

        <div class="form-group">
            <h1 class="section-title">Skills</h1>
            <div id="SkillsDisplay" class="display-box"><?php echo $row['Skills']; ?></div>
            <span class="edit-icon" onclick="toggleEditForm('editSkillsFormContainer')">&#9998;</span>
        </div>

        <div id="editSkillsFormContainer" style="display: none;" class="slide-from-right">
            <form method="post" id="editSkillsForm">
                <h1>Edit Skills</h1>
                <input type="text" id="editedSkills" name="editedSkills" value="<?php echo $row['Skills']; ?>" placeholder="Enter your skills">
                <div>
                    <button type="submit" name="add_skill" class="add-skill-btn">Save skills</button>
                    <button type="button" class="add-skill-btn" onclick="toggleEditForm('editSkillsFormContainer')">Cancel</button>
                </div>
            </form>
        </div>

        <div class="form-group">
            <h1 class="section-title">Education</h1>
            <div id="educationDisplay" class="display-box"><?php echo $row['Education']; ?></div>
            <span class="edit-icon" onclick="toggleEditForm('editEducationForm')">&#9998;</span>
        </div>

        <div id="editEducationForm" style="display: none;" class="slide-from-right">
            <form method="post" id="editEducationForm">
                <h1>Edit Education</h1>
                <input type="text" id="editedEducation" name="editedEducation" value="<?php echo $row['Education']; ?>" placeholder="Enter your education">
                <div>
                    <button type="submit" name="add_education" class="add-skill-btn">Save Education</button>
                    <button type="button" class="add-skill-btn" onclick="toggleEditForm('editEducationForm')">Cancel</button>
                </div>
            </form>
        </div>

        <div class="form-group">
            <h1 class="section-title">Work Experience</h1>
            <div id="workExperienceDisplay" class="display-box"><?php echo $row['work_experience']; ?></div>
            <span class="edit-icon" onclick="toggleEditForm('editWorkExperienceForm')">&#9998;</span>
        </div>

        <div id="editWorkExperienceForm" style="display: none;" class="slide-from-right">
            <form method="post" id="editWorkExperienceForm">
                <h1>Edit Work Experience</h1>
                <input type="text" id="editedWorkExperience" name="editedWorkExperience" value="<?php echo $row['work_experience']; ?>" placeholder="Enter your work experience">
                <div>
                    <button type="submit" name="add_ex" class="add-skill-btn">Save Work Experience</button>
                    <button type="button" class="add-skill-btn" onclick="toggleEditForm('editWorkExperienceForm')">Cancel</button>
                </div>
            </form>
        </div>

        <div class="form-group">
            <h1 class="section-title">Language</h1>
            <div id="selectedLanguageBox" class="language-box">
                <?php echo '<div>' . $row['language'] . '</div>'; ?>
            </div>
            <button type="button" class="add-skill-btn" onclick="toggleLanguageSelectForm()">Add Language</button>
        </div>
    </div>

    <form method="post" id="languageSelectForm" style="display: none;">
        <input type="text" id="languageSearch" onkeyup="filterLanguages()" placeholder="Search for a language...">
        <select name="lan[]" id="languageSelect" multiple>
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
        <!--<button type="button" onclick="saveLanguage()">Save</button>-->
        <button type="submit" name="add_lan">Save</button>
        
    </form>

    <script>
        function displayProfilePicture(event) {
            var profilePicture = document.getElementById('profilePicture');
            profilePicture.src = URL.createObjectURL(event.target.files[0]);
        }

        function toggleEditForm(formId) {
            var editForm = document.getElementById(formId);
            if (editForm.style.display === 'none' || editForm.style.display === '') {
                editForm.style.display = 'block';
            } else {
                editForm.style.display = 'none';
            }
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

        function saveLanguage() {
            const select = document.getElementById('languageSelect');
            const selectedLanguages = [];
            for (let i = 0; i < select.options.length; i++) {
                if (select.options[i].selected) {
                    selectedLanguages.push(select.options[i].value);
                }
            }

            /*const formData = new FormData();
            formData.append('language', JSON.stringify(selectedLanguages));
            formData.append('id', "<?php echo $id; ?>");

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
            });*/

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

        document.addEventListener("DOMContentLoaded", function() {
            fetchLanguages();
        });

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
