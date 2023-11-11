<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Menus</title>
    <link rel="stylesheet" href="../CSS/verify-nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    
        <div class="container-fluid">
          <button class="navbar-toggler" id="span" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" id="home" aria-current="page" href="../HTML/home.html">HOME</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="sign-in" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
                 LOG-IN
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="../php/login.php">LOG-IN</a></li>
                  <li class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="../php/signup.php">SIGN-UP</a></li>
                 
                </ul>
              </li>
             
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  ABOUT
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="../HTML/about.html">THE WEBSITE</a></li>
                  <li><a class="dropdown-item" href="../HTML/about.html">RESEARCH TEAM</a></li>
                  <li><a class="dropdown-item" href="../HTML/about.html">DEVELOPERS</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a id="category-link" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  CATEGORY
                </a>
                
                <ul class="dropdown-menu">
                
                  <li><a class="dropdown-item" href="../HTML/categories.html">QCU Star: Journal of Science and Technology</a></li>
                  <li><a class="dropdown-item" href="../HTML/categories.html">QCU Gravel: Journal of Social Sciences and Business</a></li>
                  <li><a class="dropdown-item" href="../HTML/categories.html">QCU Lamp: Journal of Education</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="home" aria-current="page" href="#">News</a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" style="cursor: pointer;">POPULAR</a>
              </li>
      
            
            
              <div class="input-group input-group-sm " id="search-container" role="search" data-bs-theme="light" >
                <input class="form-control"  id="search" type="search" placeholder="Search by Title or Author" aria-label="Search">
             
              </div>


            </ul>
      
          
         
          </div>
        </div>
     
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
      <script src="../JS/home.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
      <script>
          // Get the "HOME" anchor tag
        // Get the "HOME" anchor tag

      </script>
</body>
</html>