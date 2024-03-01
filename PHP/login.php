<?php

if (!isset($_SESSION['LOGGED_IN']) || $_SESSION['LOGGED_IN'] !== true) {
	header('Location: ./index.php');
	exit();
  }

?>

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
    <div class="form-container d-none d-sm-flex" id="login-banner">
        <img src="../images/qcu-bg.jpg" class="image-cover">
        <div class="d-flex flex-column gap-4" style="width:75%">
          <h2 class="font-weight-bold text-xl" style=" font-weight:600;"><span>Quezon City University <span >Journals</span></span> </h2>
          <span>Enjoy unrestricted access to all articles without logging in! For a tailored experience, exclusive features, and to stay updated with our latest content, log in now.</span>
          <div class="d-none d-md-flex gap-1 flex-wrap w-75">
            <span class="features">Personalized recommendations</span> 
            <span class="features">Submit articles</span>
            <span class="features">Become a reviewer</span>
            <span class="features">Download Articles</span>
          </div>
          
          <button class="btn text-white w-50"  style="background-color:#E56F1F" onclick="window.location.href='browse-articles.php'">
            Browse Now
          </button>
        </div>
    </div>
    <div class="form-container">
        <form method="post" id="form" class="bg-white">
            <p class="h4" id="login-label" style="color:rgb(33, 33, 33); font-family: Arial, Helvetica, sans-serif; font-weight:bold">Log in and Access your Account</p>
            <div class="input-field ">
               <label for="email">Email:</label>
               <input type="email" class="input form-control text-xs" name="email"  id="email" placeholder="Enter your email">
            </div>
           
            <div class="input-field">
               <label for="password">Password:</label>
               <input type="password" class="input form-control text-xs" name="password"  id="password" placeholder="Enter your password">
            </div>
            
            <!-- <div class="border rounded mt-2 p-2 d-flex gap-1">
               <div class="d-flex flex-column">
                   <label for="password" class="w-50">Enter captcha: </label>
                   <input type="text" placeholder="Captcha" class="input form-control text-xs" id="cpatchaTextBox" />
               </div>
               <div class="d-flex align-items-end  ">
                   <div id="captcha" class="h-75">
                   </div>
                   <a class="p-0 m-0" onclick="createCaptcha()">
                       <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        	<path fill="none" stroke="currentColor" stroke-width="2" d="M20 8c-1.403-2.96-4.463-5-8-5a9 9 0 1 0 0 18a9 9 0 0 0 9-9m0-9v6h-6" />
                        </svg>
                   </a>
               </div>
           </div> -->
           <!-- <div id="h-captcha-container"
                class="h-captcha"
                data-sitekey="540dedd9-f0b7-412d-a713-1c4e383ee944"
             >
            </div> -->
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
            <a id="forgotPasswordLink" style="color: #0858a4; text-decoration: underline; cursor: pointer  ">Forgot Password?
                <div class="spinner-border spinner-border-sm" role="status" id="spinner" style="display: none">
                    <span class="visually-hidden"></span>
                </div>
            </a>
        </form>
        
    </div>

</div>

	

<!-- <script src="https://js.hcaptcha.com/1/api.js"></script> -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script src="../JS/hcaptcha.js"></script> -->

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