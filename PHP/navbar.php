<?php 

session_start();
require_once 'dbcon.php';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./meta.php'); ?>
    <title>Navbars</title>
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
</head>
<body>
<script>

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('cabcad916f55a998eaf5', {
  cluster: 'ap1'
});

var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) {
  alert(JSON.stringify(data));
  console.log("Notif");
});
</script>
<nav class="navbar navbar-expand-xl" style="padding:4px 3%" id="navbar-container" >
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="background-color: white; font-size:10px;">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex gap-2">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="about.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            About Us
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" style="color: black" href="general-info.php">General Information</a></li>
          <li><a class="dropdown-item" style="color: black" href="developers.php">The Developers</a></li>
          <!-- <li><a class="dropdown-item" style="color: black" href="contact-us.php">Contact us</a></li> -->
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" role="button" href="publication.php">
            Journals
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="announcement.php">Announcements</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="about.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Guidelines
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" style="color: black" href="./tutorials.php">Tutorials for Contributors</a></li>
            <li><a class="dropdown-item" style="color: black" href="./guidelines.php#templates-for-author">Templates for Author</a></li>
            <li><a class="dropdown-item" style="color: black" href="./guidelines.php">Guidelines and Policy</a></li>
            <li><a class="dropdown-item" style="color: black" href="./faqs.php">Frequently Asked Questions</a></li>
          </ul>
          <li class="d-flex d-sm-none nav-item">
            <a class="nav-link" href="donation.php">Donation</a>
          </li>
          <li class="d-flex d-sm-none nav-item">
            <a class="nav-link" href="browse-articles.php">Browse Articles</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact-us.php">Contact Us</a>
          </li>
      </ul>
   
      <?php
// Check if the user is logged in
if (!isset($_SESSION['LOGGED_IN']) || $_SESSION['LOGGED_IN'] !== true) {
    // Display login and register links
    echo '
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown" id="navlogin">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Log-in
            </a>
            <ul class="dropdown-menu dropdown-menu-end" id="login-register">
                <li><a class="dropdown-item" style="color: black" href="login.php">Log-in</a></li>
                <li><a class="dropdown-item" style="color: black" href="signup.php">Register</a></li>
            </ul>
        </li>
    </ul>';
} else {
    // User is logged in
    $userName = ucfirst($_SESSION['first_name']);
    $author_id = $_SESSION['id'];

    // Display notification bell
    echo '
    <div class="btn-group">
        <button type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" id="notification-button">
            <i class="fas fa-bell"></i>';

    // Check for notification count
    $sqlNotif = "SELECT article.article_id, article.title FROM article JOIN reviewer_assigned ON article.article_id = reviewer_assigned.article_id WHERE reviewer_assigned.author_id = :author_id AND article.status = 4 AND reviewer_assigned.accept = 0 AND reviewer_assigned.answer = 0";
    $sqlNotifRun = database_run($sqlNotif, array(':author_id' => $author_id));

    if ($sqlNotifRun !== false) {
        $notificationCount = count($sqlNotifRun);
        echo '<span id="notification-count" style="width: 10px; height: 10px; font-size: 5px; text-align: center; display: inline-block; line-height: 5px;">' . $notificationCount . '</span>';
    }

    echo '</button>
        <ul class="dropdown-menu" style="margin-left: -20px;">';

    // Display notifications
    if ($sqlNotifRun !== false) {
        foreach ($sqlNotifRun as $notif) {
            echo '
            <li style="padding: 8px; list-style-type: none; font-size: 12px; display: block;">
                <p class="d-flex flex-column">You have been invited as Reviewer 
                    <span style="font-weight: bold; margin-top: 15px; margin-bottom: -15px;">Title: </span>
                    <a id="inviteMessage" style="text-decoration: none; color: gray; display: block; border-bottom: 1px gray solid; padding-bottom: 5px;" href="./review-process.php?id=' . $notif->article_id . '">' . $notif->title . '</a>
                </p>
            </li>';
        }
    } else {
        echo '<p class="h6" style="color: gray; font-weight: normal; margin-left: 10px;">0 Notification</p>';
    }

    echo '</ul>
    </div>';

    // Display user profile and menu
    $sqlUserName = "SELECT first_name FROM author WHERE author_id = :author_id";
    $sqlRunName = database_run($sqlUserName, array(':author_id' => $author_id));

    if ($sqlRunName !== false && isset($sqlRunName[0]->first_name)) {
        $userName = ucfirst($sqlRunName[0]->first_name);
    } else {
        // Handle case when user name is not found or database query fails
        $userName = ''; // Set a default value or handle as needed
    }

    // Display user profile and menu
    echo '
    <div class="profile px-4">
        <a id="user-profile" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            ' . $userName . '
        </a>
        <li class="dropdown" style="list-style-type: none;">
            <ul class="dropdown-menu" style="width: 230px; margin-left: -120px; margin-top: 20px;">';

    // Display different menu items based on user role
    if ($_SESSION['LOGGED_IN'] === true) {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') {
            $dashboardLink = isset($_SESSION['journal_id']) && $_SESSION['journal_id'] !== null && $_SESSION['journal_id'] != 0 ?
                '<a href="../Admin/php/editordashboard.php" class="dropdown-item" style="color: black;">Editor in Chief Dashboard</a>' :
                '<a href="../Admin/php/dashboard.php" class="dropdown-item" style="color: black;">Admin Dashboard</a>';
            echo $dashboardLink;
        }
    }

    echo '
            <li><a href="user-dashboard.php" class="dropdown-item" style="color: black;">My Profile</a></li>
            <li><a href="author-dashboard.php" class="dropdown-item" style="color: black;">My Contributions</a></li>
            <li><a class="dropdown-item" href="../PHP/logout.php" style="color: black;">Log-out</a></li> 
        </ul>
    </li>
    </ul>
    </div>';

   
}
?>

</nav>





    
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../JS/navbar.js"></script>
</body>
</html>

