
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
<nav class="navbar navbar-expand-lg " id="navbar-container" >
  <div class="container-fluid">
   
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="background-color: white; margin-left: 50px">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        </li>
        <?php
        session_start();
        if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {

        } else {
        echo '
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Log-in
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" style="color: black" href="login.php" >Log-in</a></li>
          <li><a class="dropdown-item" style="color: black" href="signup.php">Register</a></li>
          </ul>
        </li>
      ';
    }
      ?>
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
          <a class="nav-link" href="editorial.php">Editorial</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="announcement.php">Announcements</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      </form>


<?php
if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
  $userName = ucfirst($_SESSION['first_name']);
    echo '
    <div class="profile">
    <a id="user-profile" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    '. $userName .'
   </a>
        <li class="nav-item dropdown" style="list-style-type: none;">
            <ul class="dropdown-menu" style="width: 200px; margin-left: -120px; margin-top: 20px">
              <li><a href="../admin/php/journalview.php" class="dropdown-item"  style="color: black;">Admin Dashboard</a></li>
              <li><a href="author-dashboard.php" class="dropdown-item"  style="color: black;">Author Dashboard</a></li>
              <li><a href="reviewer-dashboard.php"  class="dropdown-item" style="color: black;">Reviewer Dashboard</a></li>
              <li><a href="author-dashboard.php"  class="dropdown-item" style="color: black;">Update Profile</a></li>
              <li><a class="dropdown-item" href="../PHP/logout.php"  style="color: black;">Log-out</a></li> 
            </ul>
           
        </li>
    </div>';
}
?>

    </div>
  </div>
</nav>

    
    
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</body>
</html>