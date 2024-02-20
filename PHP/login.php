<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./meta.php'); ?>
    <title>QCU TIMES | LOG-IN</title>
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="header-container" id="header-container">
</div>

<nav class="navigation-menus-container"  id="navigation-menus-container">
</nav>
<div class="d-flex">
    <div class="form-container" style="background-color: #fafcff   ">
        <div class="d-flex flex-column gap-4" style="width:75%">
          <h2 class="font-weight-bold text-xl" style="font-size:40px; font-weight:600;"><span>Quezon City University <span >Journals</span></span> </h2>
          <span>Enjoy unrestricted access to all articles without logging in! For a tailored experience, exclusive features, and to stay updated with our latest content, log in now.</span>
          <div>
            <span class="features">Personalized recommendations</span> 
            <span class="features">Submit articles</span>
            <span class="features">Become a reviewer</span>
            <span class="features">Display your Contributions</span>
            <span class="features">Download Articles</span>
          </div>
          
          <button class="btn text-white w-50"  style="background-color:#0858a4" onclick="window.location.href='browse-articles.php'">
            Browse Now
          </button>
        </div>
    </div>
    <div class="form-container">
        <form method="post" id="form">
            <p class="h4" id="login-label" style="color:rgb(33, 33, 33); font-family: Arial, Helvetica, sans-serif; font-weight:bold">Log in and Access your Account</p>
            <div class="input-field ">
               <label for="email">Email:</label>
               <input type="email" class="input form-control text-xs" name="email"  id="email" placeholder="Enter your email">
            </div>
           
            <div class="input-field">
               <label for="password">Password:</label>
               <input type="password" class="input form-control text-xs" name="password"  id="password" placeholder="Enter your password">
               
            </div>
            
            <a id="forgotPasswordLink" style="color: #0858a4; text-decoration: underline; cursor: pointer  ">Forgot Password?
                <div class="spinner-border spinner-border-sm" role="status" id="spinner" style="display: none">
                    <span class="visually-hidden"></span>
                </div>
            </a>
            
            <button type="submit" class="btn btn-primary btn-sm mt-4" id="login-button" disabled>
                    <span id="login-text">Login</span>
                    <div class="spinner-border spinner-border-sm" role="status" id="login-spinner" hidden>
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <span id="logging-in-text" style="display: none;">Logging in...</span>
            </button>
            <span id="countDown" style="color: red"></span>
            <!-- <input class="btn btn-outline-danger btn-sm" type="button" value="Register" id="register-button" onclick="window.location.href= '../PHP/signup.php';"> -->
            <button class="btn btn-outline-primary btn-sm" type="button" value="Register" id="register-button" onclick="window.location.href= '../PHP/signup.php';">Register</button>
            
        </form>
        
    </div>

</div>

	


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../JS/login.js"></script>
<script src="../JS/reusable-header.js"></script>

    <script>
            document.getElementById('login-button').addEventListener('click', function() {
            document.getElementById('login-text').style.display = 'none';
            document.getElementById('login-spinner').hidden = false;
        });
    </script>
</body>
</html>