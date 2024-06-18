<?php include('vdataconnection.php'); ?>
<?php include('employer session.php'); ?>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>
        Application | Job Help
    </title>
    <link rel="stylesheet" type="text/css" href="employer view applications.css">
    <link rel="icon" href="general_image/jobhelper_logo.png">
</head>


<?php
$id = $_SESSION['id'];

if (isset($_POST['logout'])) {
    session_destroy();
    echo '<script>alert("Log-Out successful!");window.location.href="employer login.php";</script>';
}


if (isset($_POST['download_resume'])) {
    $resume_id = $_POST['dresume'];
    $result = mysqli_query($connect, "SELECT * FROM `applications` WHERE id = '$resume_id'");

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $file = $row['resume'];
        $filename = 'resume_' . $resume_id . '.pdf';

        // 确认文件存在
        if (file_exists($file)) {
            // 清除所有输出缓冲区
            while (ob_get_level()) {
                ob_end_clean();
            }

            // 设置适当的头信息以下载 PDF
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($file));
            header('Accept-Ranges: bytes');

            // 读取并输出文件内容
            readfile($file);
            exit;
        } else {
            echo '<script>alert("File does not exist.");</script>';
        }
    }
}

if (isset($_POST['download_letter'])) {
    $letter_id = $_POST['dletter'];
    $result = mysqli_query($connect, "SELECT * FROM `applications` WHERE id = '$letter_id'");

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $file = $row['cover_letter'];
        $filename = 'cover_letter_' . $letter_id . '.pdf';

        // 确认文件存在
        if (file_exists($file)) {
            // 清除所有输出缓冲区
            while (ob_get_level()) {
                ob_end_clean();
            }

            // 设置适当的头信息以下载 PDF
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($file));
            header('Accept-Ranges: bytes');

            // 读取并输出文件内容
            readfile($file);
            exit;
        } else {
            echo '<script>alert("File does not exist.");</script>';
        }
    }
}



if (isset($_POST['view_letter'])) {
    $letter_id = $_POST['letter'];
    $letter_result = mysqli_query($connect, "SELECT * FROM `applications` WHERE id = '$letter_id'");

    if ($letter_result) {
        $letter_row = mysqli_fetch_assoc($letter_result);
        $letter_file = $letter_row['cover_letter'];
        // $filename = $row['letter_name'];

        // 确认文件存在
        if (file_exists($letter_file)) {
            // 清除所有输出缓冲区
            while (ob_get_level()) {
                ob_end_clean();
            }

            // 设置适当的头信息以展示 PDF
            header('Content-Type: application/pdf');
            // header('Content-Disposition: inline; filename="' . $filename . '"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');

            // 读取并输出文件内容
            readfile($letter_file);
            exit;
        }
    }
}


if (isset($_POST['view_resume'])) {
    $resume_id = $_POST['resume'];
    $resume_result = mysqli_query($connect, "SELECT * FROM `applications` WHERE id = '$resume_id'");

    if ($resume_result) {
        $resume_row = mysqli_fetch_assoc($resume_result);
        $resume_file = $resume_row['resume'];
        //$filename = $row['resume_name'];


        // 确认文件存在
        if (file_exists($resume_file)) {
            // 清除所有输出缓冲区
            while (ob_get_level()) {
                ob_end_clean();
            }

            // 设置适当的头信息以展示 PDF
            header('Content-Type: application/pdf');
            // header('Content-Disposition: inline; filename="' . $filename . '"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');

            // 读取并输出文件内容
            readfile($resume_file);
            exit;
        }
    }
}



if(isset($_POST['reject']))
{
    $id = $_POST['reject_id'];

    mysqli_query($connect,"UPDATE `applications` SET
    `status` = 'Failed'
    WHERE id = '$id'");

    ?>
    <script>
        alert("Reject successfully!");
        window.location = "employer view application.php";
    </script>


    <?php

}

if(isset($_POST['accept']))
{
    $id = $_POST['accept_id'];

    mysqli_query($connect,"UPDATE `applications` SET
    `status` = 'Successful'
    WHERE id = '$id'");

    ?>
    <script>
        alert("Reject successfully!");
        window.location = "employer view application.php";
    </script>


    <?php

}



?>

<body>
<br/> <br/>
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
        <form method="post">
            <button id="logout" name="logout" onclick='return userconfirmation();'><img src='img/logout.png' id="logout_photo">LOG OUT</button>
        </form>
    </header>

<br/><br/>



<?php
$all = mysqli_query($connect, "SELECT DISTINCT post_id FROM `applications` WHERE poster_id = '$id'");

        if(mysqli_num_rows($all) > 0)
        {
            ?>
                <h1>Manage your application</h1>
                <br/><br/>
            <?php
        }
        else
        {
            ?>
            <br/><br/>
            <div class="none_mid">
                <b>Not jobseeker apply your job yet.</b>
                <br/><br/>
                You can add your job description to attract candidates.
            </div>

                
            <?php
        }


while ($row = mysqli_fetch_assoc($all)) {
    $post_id = $row['post_id'];

    $job = mysqli_query($connect, "SELECT * FROM `post` WHERE post_id = '$post_id'");
    if ($job) {
        $job_row = mysqli_fetch_assoc($job);
        $jname = $job_row['job_name'];
    }

    // 用于跟踪已经显示过的 jobseeker_id
    $displayed_candidates = array();
    ?>

    <h3 class="mid_content">Your post <?php echo $post_id ?></h3>

    <?php
        $result = mysqli_query($connect, "SELECT * FROM `applications` WHERE post_id = '$post_id' and `status` = 'Pending'");


        while ($row = mysqli_fetch_assoc($result)) {
            $candidate_id = $row['jobseeker_id'];
            $app_id = $row['id'];
            $status = $row['status'];
    ?>


    <h2 class="mid_content">The candidate list apply for job of <?php echo $jname ?></h2>

    <table>
        <tr>
            <th>Candidate Name</th>
            <th>Personal Summary</th>
            <th>Skill</th>
            <th>Work Experience</th>
            <th>Education</th>
            <th>Language</th>
            <th>Status</th>
            <th>Resume</th>
            <th>Cover Letter</th>
            <th>Action</th>
        </tr>

        <?php
        
            

            // 如果已经显示过这个人，就会跳过
            if (in_array($candidate_id, $displayed_candidates)) {
                continue;
            }

            $jobseeker = mysqli_query($connect, "SELECT * FROM `jobseeker` WHERE jobseeker_id = '$candidate_id'");

            if ($jobseeker) {
                $jobseeker_row = mysqli_fetch_assoc($jobseeker);
                $name = $jobseeker_row['jobseeker_firstname'] . " " . $jobseeker_row['jobseeker_lastname'];
            }

            $candidate = mysqli_query($connect, "SELECT * FROM `userprofile` WHERE UserID = '$candidate_id'");

            if ($candidate) {
                $candidate_row = mysqli_fetch_assoc($candidate); 
                $ps = $candidate_row['PersonalSummary'];
                $skill = $candidate_row['Skills'];
                $ex = $candidate_row['work_experience'];
                $education = $candidate_row['Education'];
                $language = $candidate_row['language'];

            }
            ?>
            <tr>
                <td><?php echo $name ?></td>
                <td><?php echo $ps ?></td>
                <td><?php echo $skill ?></td>
                <td><?php echo $ex ?></td>
                <td><?php echo $education ?></td>
                <td><?php echo $language ?></td>
                <td><?php echo $status ?></td>
                <td>
                    <form method="post">
                        <button type="submit" name="view_resume">
                        view
                        </button>
                        <input type="hidden" name="resume" value="<?php echo $app_id ?>">

                        <br>
                        <br>

                        <button type="submit" name="download_resume">
                        Download
                        </button>
                        <input type="hidden" name="dresume" value="<?php echo $app_id ?>">
                    </form>
                </td>
                <td>
                    <form method="post">
                        <button type="submit" name="view_letter">
                        view
                        </button>
                        <input type="hidden" name="letter" value="<?php echo $app_id ?>">
                        <br>
                        <br>

                        <button type="submit" name="download_letter">
                        Download
                        </button>
                        <input type="hidden" name="dletter" value="<?php echo $app_id ?>">
                    </form>
                </td>
                <td>
                    <form method="post">
                        <button type="submit" name="accept">
                        Accept
                        </button>
                        <input type="hidden" name="accept_id" value="<?php echo $app_id ?>">
                        <br>
                        <br>

                        <button type="submit" name="reject">
                        Reject
                        </button>
                        <input type="hidden" name="reject_id" value="<?php echo $app_id ?>">
                    </form>
                </td>
            </tr>
            <?php
            // 将已经显示过的 jobseeker_id 添加到数组中
            $displayed_candidates[] = $candidate_id;
        }
        ?>

    </table>

        <!--这里开始是看accept的-->

        <?php
            $result = mysqli_query($connect, "SELECT * FROM `applications` WHERE post_id = '$post_id' and `status` = 'Successful'");
            while ($row = mysqli_fetch_assoc($result)) {
                $candidate_id = $row['jobseeker_id'];
                $app_id = $row['id'];
                $status = $row['status'];
        ?>
        
    
    <h2 class="mid_content">The candidate list you accept to apply for job of <?php echo $jname ?></h2>

    <table>
        <tr>
            <th>Candidate Name</th>
            <th>Personal Summary</th>
            <th>Skill</th>
            <th>Work Experience</th>
            <th>Education</th>
            <th>Language</th>
            <th>Status</th>
            <th>Resume</th>
            <th>Cover Letter</th>
        </tr>

        <?php
        
            

            // 如果已经显示过这个人，就会跳过
            if (in_array($candidate_id, $displayed_candidates)) {
                continue;
            }

            $jobseeker = mysqli_query($connect, "SELECT * FROM `jobseeker` WHERE jobseeker_id = '$candidate_id'");

            if ($jobseeker) {
                $jobseeker_row = mysqli_fetch_assoc($jobseeker);
                $name = $jobseeker_row['jobseeker_firstname'] . " " . $jobseeker_row['jobseeker_lastname'];
            }

            $candidate = mysqli_query($connect, "SELECT * FROM `userprofile` WHERE UserID = '$candidate_id'");

            if ($candidate) {
                $candidate_row = mysqli_fetch_assoc($candidate); 
                $ps = $candidate_row['PersonalSummary'];
                $skill = $candidate_row['Skills'];
                $ex = $candidate_row['work_experience'];
                $education = $candidate_row['Education'];
                $language = $candidate_row['language'];

            }
            ?>
            <tr>
                <td><?php echo $name ?></td>
                <td><?php echo $ps ?></td>
                <td><?php echo $skill ?></td>
                <td><?php echo $ex ?></td>
                <td><?php echo $education ?></td>
                <td><?php echo $language ?></td>
                <td><?php echo $status ?></td>
                <td>
                    <form method="post">
                        <button type="submit" name="view_resume">
                        view
                        </button>
                        <input type="hidden" name="resume" value="<?php echo $app_id ?>">

                        <br>
                        <br>

                        <button type="submit" name="download_resume">
                        Download
                        </button>
                        <input type="hidden" name="dresume" value="<?php echo $app_id ?>">
                    </form>
                </td>
                <td>
                    <form method="post">
                        <button type="submit" name="view_letter">
                        view
                        </button>
                        <input type="hidden" name="letter" value="<?php echo $app_id ?>">
                        <br>
                        <br>

                        <button type="submit" name="download_letter">
                        Download
                        </button>
                        <input type="hidden" name="dletter" value="<?php echo $app_id ?>">
                    </form>
                </td>
               
            </tr>
            <?php
            // 将已经显示过的 jobseeker_id 添加到数组中
            $displayed_candidates[] = $candidate_id;
        }
        ?>

    </table>

    <br><br><br><br><br>

    <?php
}
?>

<script>
    function userconfirmation()
        {
            answer = confirm("Do you want to log out?");
            return answer;
        }
</script>

<footer>
        <nav>
            <ul>
                <li><a href="employer about us.php">About Us</a></li>
                <li><a href="employer contact us.php">Contact Us</a></li>
            </ul>
        </nav>
    </footer>
</body>
</html>