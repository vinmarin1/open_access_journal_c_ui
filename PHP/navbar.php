
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbars</title>
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg p-0" id="navbar-container" >
  <div class="container-fluid p-0">
   
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="background-color: white; margin-left: 50px">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex gap-2">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="about.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            About
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" style="color: black" href="#">THE WEBSITE</a></li>
          <li><a class="dropdown-item" style="color: black" href="#">RESEARCH TEAM</a></li>
          <li><a class="dropdown-item" style="color: black" href="#">DEVELOPERS</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" role="button" href="publication.php">
            QCU Journals
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="announcement.php">Announcements</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="announcement.php">Guidelines</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      </form>
      
      <?php
        session_start();
        if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {

        } else {
        echo '
        <li class="nav-item dropdown py-2 px-4">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Log-in
          </a>
          <ul class="dropdown-menu" style="margin-left: -50px; width: 100px">
          <li><a class="dropdown-item" style="color: black" href="login.php" >Log-in</a></li>
          <li><a class="dropdown-item" style="color: black" href="signup.php">Register</a></li>
          </ul>
        </li>
      ';
    }
      ?>

    </div>
  </div>

<?php
if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
  $userName = ucfirst($_SESSION['first_name']);
    echo '

    <div id="notification-container">
      <button id="notification-button">
        <i class="fas fa-bell"></i>
        <span id="notification-count"></span>
      </button>
      <div id="notification-box"></div>
    </div>



    <div class="profile px-4">
    <a id="user-profile" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    '. $userName .'
   </a>
        <li class="dropdown" style="list-style-type: none;">
            <ul class="dropdown-menu" style="width: 200px; margin-left: -120px; margin-top: 20px">
            <li><a href="../Admin/php/journalview.php" class="dropdown-item"  style="color: black;">Admin Dashboard</a></li>
              <li><a href="#" class="dropdown-item"  style="color: black;">My Profile</a></li>
              <li><a href="author-dashboard.php" class="dropdown-item"  style="color: black;">My Contributions</a></li>
            
              <li><a href="author-dashboard.php"  class="dropdown-item" style="color: black;">Update Profile</a></li>
              <li><a class="dropdown-item" href="../PHP/logout.php"  style="color: black;">Log-out</a></li> 
            </ul>
        </li>
    </div>';
}

?>

</nav>

<script>
  document.body.addEventListener('click', function (event) {
    var notificationBox = document.getElementById('notification-box');
    var pointsBox = document.getElementById('points-box');
    var notificationButton = document.getElementById('notification-button');
    var pointsButton = document.getElementById('points-button');

    if (!event.target.closest('#notification-container') && notificationBox.style.display === 'block') {
      notificationBox.style.display = 'none';
    }

    if (!event.target.closest('#points-container') && pointsBox.style.display === 'block') {
      pointsBox.style.display = 'none';
    }
  });

  <?php
  $notificationCount = 3;
  echo "var notificationCount = $notificationCount;\n";
  ?>

  function toggleNotification() {
    var notificationBox = document.getElementById('notification-box');
    var notificationCountElement = document.getElementById('notification-count');

    var notifications = [
      "New message received!",
      "You have a meeting at 2 PM.",
      "Check your email for updates."
    ];

    notificationBox.innerHTML = '';

    notifications.forEach(function (message) {
      var notification = document.createElement('div');
      notification.className = 'notification-item';
      notification.textContent = message;
      notificationBox.appendChild(notification);
    });

    // Update notification count
    notificationCount += notifications.length;

    // Update the notification count element
    notificationCountElement.textContent = notificationCount;

    // Reset the count when the notification box is opened
    if (notificationBox.style.display === 'none' || notificationBox.style.display === '') {
      notificationCount = 0;
      notificationCountElement.textContent = 0;
    }

    notificationBox.style.display = (notificationBox.style.display === 'none' || notificationBox.style.display === '') ? 'block' : 'none';

    
    notificationCountElement.style.display = 'none';
  }

  document.getElementById('notification-button').addEventListener('click', toggleNotification);

  var pointsCount = 50; // Set the initial count of points
  var pointsBox = document.getElementById('points-box');
  var pointsCountElement = document.getElementById('points-count');

  // Example point updates
  var pointUpdates = [
    "Earned 10 points for completing a task.",
    "Received 10 points for logging in.",
    "Achieved a bonus of 20 points."
  ];

  // Display each point update
  pointUpdates.forEach(function (message) {
    var pointUpdate = document.createElement('div');
    pointUpdate.className = 'point-update-item';
    pointUpdate.textContent = message;
    pointsBox.appendChild(pointUpdate);
  });

  pointsCount += calculateTotalPoints(pointUpdates);

  // Update the points count element
  pointsCountElement.textContent = pointsCount;

  function togglePoints() {
    pointsBox.style.display = (pointsBox.style.display === 'none' || pointsBox.style.display === '') ? 'block' : 'none';
  }

  function calculateTotalPoints(updates) {
    return updates.reduce(function (total, update) {
      var earnedPoints = parseInt(update.match(/\d+/)[0]); // Extract points from the update message
      return total + (isNaN(earnedPoints) ? 0 : earnedPoints);
    }, 0);
  }
</script>

    
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</body>
</html>