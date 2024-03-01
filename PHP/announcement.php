<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./meta.php'); ?>
    <title>QCU PUBLICATION | ANNOUNCEMENTS</title>
    <link rel="stylesheet" href="../CSS/announcement.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="header-container" id="header-container">
<!-- header will be display here by fetching reusable files -->
</div>

<nav class="navigation-menus-container"  id="navigation-menus-container">
<!-- navigation menus will be display here by fetching reusable files -->
</nav>

<div class="main-container">
    <div class="content-over">
        <div class="cover-content">
            <p>Home / Announcements</p>
            <h2>Announcements</h2>
        </div>
    </div> 
</div>


    <div class="container-fluid">
    <?php
    $hostname = "srv1158.hstgr.io"; 
    $dbuser = "u944705315_qcuj2024";
    $dbpass = "Qcujournal1234.";
    $dbName = "u944705315_qcuj2024";
    $conn = mysqli_connect($hostname, $dbuser, $dbpass, $dbName);
    if (!$conn) {
        die("connection is not available");
    }

    $sql = "SELECT * FROM announcement WHERE announcementtype = 'Annoucement' AND status = 1 ORDER BY date_added DESC LIMIT 3";
    $result = mysqli_query($conn, $sql);
    $announcementCount = mysqli_num_rows($result);

        if ($announcementCount > 0) {
        // Variable to store HTML for announcements
        $announcementsHTML = "";

        // Fetch the first announcement
        $row = mysqli_fetch_array($result);
        $announcementId = $row["announcement_id"];
        $type = $row["announcementtype"];
        $title = $row["title"];
        $description = $row["announcement_description"];
        $announcement = $row["announcement"];
        $img = $row["upload_image"];
        $dateAdded = $row["date_added"];

        // HTML structure for the first announcement
        $firstAnnouncementHTML = "<div class='row mb-3'>
                                    <div class='col-md-4'>
                                        <div class='border-joy mt-5 text-center'>
                                            <img src='../Files/announcement-image/$img' alt='#' class='img-fluid'>
                                        </div>
                                    </div>
                                    <div class='col-md-6'>
                                        <div class='announce-text mt-5' style='text-align:justify'>
                                            <h2>$title</h2>
                                            <br>
                                            <p>$announcement</p>
                                        </div>
                                    </div>
                                </div>";

        // Append the HTML for the first announcement
        $announcementsHTML .= $firstAnnouncementHTML;

        // Fetch the second announcement
        if ($row = mysqli_fetch_array($result)) {
            $announcementId = $row["announcement_id"];
            $type = $row["announcementtype"];
            $title = $row["title"];
            $description = $row["announcement_description"];
            $announcement = $row["announcement"];
            $img = $row["upload_image"];
            $dateAdded = $row["date_added"];

            // HTML structure for the second announcement within the specified div structure
            $secondAnnouncementHTML = "<div class='row mb-3'>
                                        <div class='col-md-2'></div>
                                        <div class='col-md-4 order-md-2'>
                                            <div class='border-joy mt-5 text-center'>
                                                <img src='../Files/announcement-image/$img' alt='#' class='img-fluid'>
                                            </div>
                                        </div>
                                        <div class='col-md-6 order-md-1'>
                                            <div class='announce-text mt-5' style='text-align:justify'>
                                                <h2>$title</h2>
                                                <br>
                                                <p>$announcement</p>
                                            </div>
                                        </div>
                                    </div>";

            // Append the HTML for the second announcement
            $announcementsHTML .= $secondAnnouncementHTML;
        }

        // Fetch the third announcement
        if ($row = mysqli_fetch_array($result)) {
            $announcementId = $row["announcement_id"];
            $type = $row["announcementtype"];
            $title = $row["title"];
            $description = $row["announcement_description"];
            $announcement = $row["announcement"];
            $img = $row["upload_image"];
            $dateAdded = $row["date_added"];

            // HTML structure for the third announcement, similar to the first announcement
            $thirdAnnouncementHTML = "<div class='row mb-3'>
                                        <div class='col-md-4'>
                                            <div class='border-joy mt-5 text-center'>
                                                <img src='../Files/announcement-image/$img' alt='#' class='img-fluid'>
                                            </div>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class='announce-text mt-5' style='text-align:justify'>
                                                <h2>$title</h2>
                                                <br>
                                                <p>$announcement</p>
                                            </div>
                                        </div>
                                    </div>";

            // Append the HTML for the third announcement
            $announcementsHTML .= $thirdAnnouncementHTML;
        }

        // Echo out the HTML for announcements
        echo $announcementsHTML;
    }
    ?>     
    </div>

<div class="container-fluid mb-3 featured">
</div>

<div class="container-fluid">
<?php
    $hostname = "srv1158.hstgr.io"; 
    $dbuser = "u944705315_qcuj2024";
    $dbpass = "Qcujournal1234.";
    $dbName = "u944705315_qcuj2024";
    $conn = mysqli_connect($hostname, $dbuser, $dbpass, $dbName);
    if (!$conn) {
        die("connection is not available");
    }

    $sql = "SELECT * FROM announcement WHERE announcementtype = 'Annoucement' AND status = 1 ORDER BY date_added DESC LIMIT 3";
$result = mysqli_query($conn, $sql);
$announcementCount = mysqli_num_rows($result);

if ($announcementCount > 0) {
    // Variable to store HTML for announcements
    $announcementsHTML = "";

    // Fetch the first announcement
    $row = mysqli_fetch_array($result);
    $announcementId = $row["announcement_id"];
    $type = $row["announcementtype"];
    $title = $row["title"];
    $description = $row["announcement_description"];
    $announcement = $row["announcement"];
    $img = $row["upload_image"];
    $dateAdded = $row["date_added"];

    // HTML structure for the first announcement
    $firstAnnouncementHTML = "<div class='row mb-3'>
                                <div class='col-md-4'>
                                    <div class='border-joy mt-5 text-center'>
                                        <img src='../Files/announcement-image/$img' alt='#' class='img-fluid'>
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class='announce-text mt-5' style='text-align:justify'>
                                        <h2>$title</h2>
                                        <br>
                                        <p>$announcement</p>
                                    </div>
                                </div>
                            </div>";

    // Append the HTML for the first announcement
    $announcementsHTML .= $firstAnnouncementHTML;

    // Fetch the second announcement
    if ($row = mysqli_fetch_array($result)) {
        $announcementId = $row["announcement_id"];
        $type = $row["announcementtype"];
        $title = $row["title"];
        $description = $row["announcement_description"];
        $announcement = $row["announcement"];
        $img = $row["upload_image"];
        $dateAdded = $row["date_added"];

        // HTML structure for the second announcement within the specified div structure
        $secondAnnouncementHTML = "<div class='row mb-3'>
                                    <div class='col-md-2'></div>
                                    <div class='col-md-4 order-md-2'>
                                        <div class='border-joy mt-5 text-center'>
                                            <img src='../Files/announcement-image/$img' alt='#' class='img-fluid'>
                                        </div>
                                    </div>
                                    <div class='col-md-6 order-md-1'>
                                        <div class='announce-text mt-5' style='text-align:justify'>
                                            <h2>$title</h2>
                                            <br>
                                            <p>$announcement</p>
                                        </div>
                                    </div>
                                </div>";

        // Append the HTML for the second announcement
        $announcementsHTML .= $secondAnnouncementHTML;
    }

    // Fetch the third announcement
    if ($row = mysqli_fetch_array($result)) {
        $announcementId = $row["announcement_id"];
        $type = $row["announcementtype"];
        $title = $row["title"];
        $description = $row["announcement_description"];
        $announcement = $row["announcement"];
        $img = $row["upload_image"];
        $dateAdded = $row["date_added"];

        // HTML structure for the third announcement, similar to the first announcement
        $thirdAnnouncementHTML = "<div class='row mb-3'>
                                    <div class='col-md-4'>
                                        <div class='border-joy mt-5 text-center'>
                                            <img src='../Files/announcement-image/$img' alt='#' class='img-fluid'>
                                        </div>
                                    </div>
                                    <div class='col-md-6'>
                                        <div class='announce-text mt-5' style='text-align:justify'>
                                            <h2>$title</h2>
                                            <br>
                                            <p>$announcement</p>
                                        </div>
                                    </div>
                                </div>";

        // Append the HTML for the third announcement
        $announcementsHTML .= $thirdAnnouncementHTML;
    }

    // Echo out the HTML for announcements
    echo $announcementsHTML;
}
?> 
</div>


<div class="watch-vid">

</div>

<div class="container-fluid">
<?php
        $hostname = "srv1158.hstgr.io"; 
        $dbuser = "u944705315_qcuj2024";
        $dbpass = "Qcujournal1234.";
        $dbName = "u944705315_qcuj2024";
        $conn = mysqli_connect($hostname, $dbuser, $dbpass, $dbName);
        if (!$conn) {
            die("connection is not available");
        }


        $sql = "SELECT * FROM announcement WHERE status = 1";
        $result = mysqli_query($conn,$sql);
        while ($row=mysqli_fetch_array($result)) {
            $announcementId = $row["announcement_id"];
            $type = $row["announcementtype"];
            $title = $row["title"];
            $description = $row["announcement_description"];
            $announcement = $row["announcement"];
            $img = $row["upload_image"];
            $dateAdded = $row["date_added"];
            // $dateExpired = $row["expired_date"];

        echo " <div class='row mt-4'>
        <div class='col-md-2'>
            <div class='announcement-pic text-center'>
                <img src='$img' alt='#!' class='img-fluid'>
            </div>
        </div>
        <div class='col-md-9 policy' id='policy-top'>
        <h2>$title</h2>
            <p>$announcement</p>
            <div class='qcu-date-container'>
                <p class='qcu-name'>QCU</p>
                <p class='qcu-date'>$dateAdded</p>
            </div>
        </div>
    </div>
        ";
        }
        ?>
</div>











<div class="footer" id="footer">
    <!-- footer will be display here by fetching reusable files -->
</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="../JS/reusable-header.js"></script>
</body>
</html>