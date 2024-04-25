<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./meta.php'); ?>
    <title>QCUJ | ANNOUNCEMENTS</title>
    <link rel="stylesheet" href="../CSS/announcement.css">
    <link rel="stylesheet" href="../CSS/index.css">
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
            <h2 class="text-center">Announcements</h2>
        </div>
    </div> 
</div>


    <div class="container-fluid">
    <?php
        include("dbcon.php");
        $sql = "SELECT * FROM announcement WHERE announcementtype = 'Call for Papers' AND status = 1 ORDER BY date_added DESC LIMIT 1";
        $announcementData = database_run($sql);
        
        if ($announcementData) {

            $announcement = $announcementData[0];
            $announcementId = $announcement->announcement_id;
            $title = $announcement->title;
            $announcementText = $announcement->announcement;
            $img = $announcement->upload_image;
            $imgSrc = "../Files/announcement-image/$img";

            $callForPapersHTML = "<section class='row'>
                                    <div class='col-md-12 order-md-2'>
                                        <img src='$imgSrc' alt='#' class='w-100'>
                                    </div>
                                    <div class='col-md-12 order-md-1'>
                                        <div class='announce-text' style='text-align:justify'>
                                            <h4>$title</h4>
                                            <br>
                                            <p>$announcementText</p>
                                        </div>
                                    </div>
                                </section>";
        
            echo $callForPapersHTML;
        }
        ?>
        </div>
        
        <div class="container-fluid">
            <?php
                $sql = "SELECT * FROM announcement WHERE status = 1 AND announcementtype != 'Call for Papers'";
                $result = database_run($sql);

                if ($result !== false && !empty($result)) {
                    if (count($result) > 0) {
                        foreach ($result as $row) {
                            $title = $row->title;
                            $announcement = $row->announcement;
                            $img = $row->upload_image;
                            $dateAdded = $row->date_added;

                            echo "<section data-animate-in='up' class='row'>
                                    <div class='col-md-5 border'>
                                        <div class='announcement-pic text-center'>
                                            <img src='../Files/announcement-image/$img' alt='#!' class='img-fluid'>
                                        </div>
                                    </div>
                                    <div class='col-md-7 policy border p-4' id='policy-top'>
                                        <h4>$title</h4>
                                        <p>$announcement</p>
                                        <div class='qcu-date-container'>
                                            <p class='qcu-name'>QCU</p>
                                            <p class='qcu-date'>$dateAdded</p>
                                        </div>
                                    </div>
                                </section>";
                        }
                    } else {
                        echo "No announcements available.";
                    }
                } else {
                    echo "Error retrieving announcements.";
                }
                ?>
        </div>
    </div>


<div class="footer" id="footer">
    <!-- footer will be display here by fetching reusable files -->
</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function showAlert() {
        Swal.fire({
        icon: 'info',
        title: 'Profile Incomplete',
        text: 'Please complete the required details in profile to submit article'
        });
    }
    </script>
    <script src="../JS/reusable-header.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../JS/animate.js"></script>
    <script>
function includeNavbar() {
  fetch('../PHP/navbar.php')
    .then(response => response.text())
    .then(data => {
      document.getElementById('navigation-menus-container').innerHTML = data;
      // Now that the content is loaded, you can attach event listeners or perform other operations as needed
      // For example, you can attach the notification button click event listener here
      attachNotificationButtonListener();
      attachNotificationItemClickListener();
      playAudio();
    })
    .catch(error => console.error('Error loading navbar.php:', error));
}
// function playAudio() {
//   var x = document.getElementById("myAudio");
//   x.play();
// }


function attachNotificationButtonListener() {
  $(document).on('click', '#notification-button', function () {
    $("#notification-count").text("0");
    $("#notification-count").hide();
     
    // Send AJAX request to mark notifications as read
    $.ajax({
      url: "../PHP/mark_notifications_read.php",
      type: "POST",
      data: { author_id: <?php echo $_SESSION['id']; ?> },
      success: function (response) {
        console.log("Notifications marked as read:", response);
        // Update notification count on success
        // $("#notification-count").text("0");
        // $("#notification-count").hide();

      },
      error: function (xhr, status, error) {
        console.error("Error marking notifications as read:", error);
      }
    });
  });
}

function attachNotificationItemClickListener() {
  const notificationItems = document.querySelectorAll('.notification-item');

  notificationItems.forEach(item => {
    item.addEventListener('click', function () {
      const notificationId = this.dataset.notificationId;
      markNotificationAsRead(notificationId);
    });
  });

  function markNotificationAsRead(notificationId) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../PHP/mark_as_read.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        // Handle success or display any feedback to the user
        console.log('Notification marked as read');
      }
    };
    xhr.send('notification_id=' + encodeURIComponent(notificationId));
  }
}

// Call this function in your code wherever appropriate, such as after loading notifications
// attachNotificationItemClickListener();


// Call includeNavbar function to load navbar.php content
includeNavbar();

    </script>
</body>
</html>


<!-- 
<div class="container-fluid">
<?php
//     $hostname = "srv1158.hstgr.io"; 
//     $dbuser = "u277379385_qcuj2024";
//     $dbpass = "Qcujournal1234.";
//     $dbName = "u277379385_qcuj2024";
//     $conn = mysqli_connect($hostname, $dbuser, $dbpass, $dbName);
//     if (!$conn) {
//         die("connection is not available");
//     }

//     $sql = "SELECT * FROM announcement WHERE announcementtype = 'Announcement' AND status = 1 ORDER BY date_added DESC LIMIT 3";
// $result = mysqli_query($conn, $sql);
// $announcementCount = mysqli_num_rows($result);

// if ($announcementCount > 0) {
//     // Variable to store HTML for announcements
//     $announcementsHTML = "";

//     // Fetch the first announcement
//     $row = mysqli_fetch_array($result);
//     $announcementId = $row["announcement_id"];
//     $type = $row["announcementtype"];
//     $title = $row["title"];
//     $description = $row["announcement_description"];
//     $announcement = $row["announcement"];
//     $img = $row["upload_image"];
//     $dateAdded = $row["date_added"];

//     // HTML structure for the first announcement
//     $firstAnnouncementHTML = "<div class='row mb-3'>
//                                 <div class='col-md-4'>
//                                     <div class='border-joy mt-5 text-center'>
//                                         <img src='../Files/announcement-image/$img' alt='#' class='img-fluid'>
//                                     </div>
//                                 </div>
//                                 <div class='col-md-6'>
//                                     <div class='announce-text mt-5' style='text-align:justify'>
//                                         <h2>$title</h2>
//                                         <br>
//                                         <p>$announcement</p>
//                                     </div>
//                                 </div>
//                             </div>";

//     // Append the HTML for the first announcement
//     $announcementsHTML .= $firstAnnouncementHTML;

//     // Fetch the second announcement
//     if ($row = mysqli_fetch_array($result)) {
//         $announcementId = $row["announcement_id"];
//         $type = $row["announcementtype"];
//         $title = $row["title"];
//         $description = $row["announcement_description"];
//         $announcement = $row["announcement"];
//         $img = $row["upload_image"];
//         $dateAdded = $row["date_added"];

//         // HTML structure for the second announcement within the specified div structure
//         $secondAnnouncementHTML = "<div class='row mb-3'>
//                                     <div class='col-md-2'></div>
//                                     <div class='col-md-4 order-md-2'>
//                                         <div class='border-joy mt-5 text-center'>
//                                             <img src='../Files/announcement-image/$img' alt='#' class='img-fluid'>
//                                         </div>
//                                     </div>
//                                     <div class='col-md-6 order-md-1'>
//                                         <div class='announce-text mt-5' style='text-align:justify'>
//                                             <h2>$title</h2>
//                                             <br>
//                                             <p>$announcement</p>
//                                         </div>
//                                     </div>
//                                 </div>";

//         // Append the HTML for the second announcement
//         $announcementsHTML .= $secondAnnouncementHTML;
//     }

//     // Fetch the third announcement
//     if ($row = mysqli_fetch_array($result)) {
//         $announcementId = $row["announcement_id"];
//         $type = $row["announcementtype"];
//         $title = $row["title"];
//         $description = $row["announcement_description"];
//         $announcement = $row["announcement"];
//         $img = $row["upload_image"];
//         $dateAdded = $row["date_added"];

//         // HTML structure for the third announcement, similar to the first announcement
//         $thirdAnnouncementHTML = "<div class='row mb-3'>
//                                     <div class='col-md-4'>
//                                         <div class='border-joy mt-5 text-center'>
//                                             <img src='../Files/announcement-image/$img' alt='#' class='img-fluid'>
//                                         </div>
//                                     </div>
//                                     <div class='col-md-6'>
//                                         <div class='announce-text mt-5' style='text-align:justify'>
//                                             <h2>$title</h2>
//                                             <br>
//                                             <p>$announcement</p>
//                                         </div>
//                                     </div>
//                                 </div>";

//         // Append the HTML for the third announcement
//         $announcementsHTML .= $thirdAnnouncementHTML;
//     }

//     // Echo out the HTML for announcements
//     echo $announcementsHTML;
// }
?> 
</div>


<div class="watch-vid">

</div> -->