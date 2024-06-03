<?php include('vdataconnection.php'); ?>
<?php include('employer session.php'); ?>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>
        Application | Job Help
    </title>
    <link rel="stylesheet" type="text/css" href="employer payment history.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>
<br/> <br/>

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


?>

<nav>
    <div id="line">
        <div class="choice">
            <span class="left">
                <a href="employer home.php"><img src="img/page logo2.png" id="page_logo"/></a>
            </span>
            <span class="mid">
                <a href="employer home.php">HOME</a>
                <a href="employer drafts.php">Drafts</a>
                <a href="employer view post.php">Post</a>
                <a href="employer view application.php">Application</a>
                <a href="employer packages.php">Package</a>
                <a href="employer payment history.php">History</a>
                <a href="employer profile.php">Profile</a>
            </span>
            <form method="post">
                <span class="right">
                    <button id="logout" name="logout" onclick='return userconfirmation();'><img src='img/logout.png' id="logout_photo">LOG OUT</button>
                </span>
            </form>
        </div>
    </div>
</nav>

<br/><hr/><br/>

<h1>Manage the application</h1>
<br/><br/>

<?php
$all = mysqli_query($connect, "SELECT DISTINCT post_id FROM `applications` WHERE poster_id = '$id'");
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

    <h3>Your post <?php echo $post_id ?></h3>
    <h2>The candidate list apply for job of <?php echo $jname ?></h2>

    <table>
        <tr>
            <th>Candidate Name</th>
            <th>Personal Summary</th>
            <th>Skill</th>
            <th>Work Experience</th>
            <th>Education</th>
            <th>Language</th>
            <th>Resume</th>
            <th>Cover Letter</th>
        </tr>

        <?php
        $result = mysqli_query($connect, "SELECT * FROM `applications` WHERE post_id = '$post_id'");
        while ($row = mysqli_fetch_assoc($result)) {
            $candidate_id = $row['jobseeker_id'];
            $app_id = $row['id'];
            

            // 如果已经显示过这个 jobseeker_id，跳过
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
                <td>
                    <form method="post">
                        <button type="submit" name="view_resume">
                        view
                        </button>
                        <input type="hidden" name="resume" value="<?php echo $app_id ?>">



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
</body>
</html>