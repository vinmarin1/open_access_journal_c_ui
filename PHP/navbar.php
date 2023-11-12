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
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Log-in
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" style="color: black" href="login.php" >Log-in</a></li>
          <li><a class="dropdown-item" style="color: black" href="signup.php">Register</a></li>
         
          </ul>
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
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Publications
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" style="color: black" href="#" >Publication1</a></li>
          <li><a class="dropdown-item" style="color: black" href="#">Publication2</a></li>
          <li><a class="dropdown-item" style="color: black" href="#"></a></li>
          <li><a class="dropdown-item" style="color: black" href="#">Publication3</a></li>
          <li><a class="dropdown-item" style="color: black" href="#"></a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="archives.php">Archives</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="editorial.php">Editorial</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="announcement.php">Announcements</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Publish
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" style="color: black" href="#">Publish1</a></li>
            <li><a class="dropdown-item" style="color: black" href="#">Publish2</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" style="color: black" href="#">Publish3</a></li>
          </ul>
        </li>
      
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      
       
      </form>
    </div>
  </div>
</nav>

    
    
     
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
 
</body>
</html>