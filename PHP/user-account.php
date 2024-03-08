<?php
require 'dbcon.php';
session_start();

if (!isset($_SESSION['LOGGED_IN']) || $_SESSION['LOGGED_IN'] !== true) {
	header('Location: ./login.php');
	exit();
  }

  $id = $_SESSION['id'];
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('./meta.php'); ?>
    <title>QCU PUBLICATION | USER ACCOUNT SECURITY</title>
    <link href="../CSS/user-account.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body>
    
    <div class="header-container" id="header-container">
		<!-- header will be display here by fetching reusable files -->
	</div>

	<nav class="navigation-menus-container" id="navigation-menus-container">
		<!-- navigation menus will be display here by fetching reusable files -->
	</nav>


    

<div class="container-fluid">
  <div class="row">
    <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
      <div class="position-sticky">
        <ul class="nav flex-column">
          <li class="nav-items-header">
            <p class="h2 mt-4">Settings</p>
          </li>
          <li class="nav-items">
            <a class="nav-link" href="#">
                <i class="fa-solid fa-user"></i> Your Profile
            </a>
          </li>
          <li class="nav-items">
            <a class="nav-link" href="#">
              <i class="ri-account-circle-fill"></i> Account
            </a>
          </li>
          <li class="nav-items">
            <a class="nav-link" href="#">
                <i class="fa-solid fa-shield-halved"></i> Security
            </a>
          </li>
          <li class="nav-items">
            <a class="nav-link" href="#">
              <i class="ri-shield-check-fill"></i> Terms and Privacy
            </a>
          </li>
          <hr>
          <li class="nav-items">
            <a class="nav-link" href="#">
                <i class="fa-solid fa-message"></i> Give Feedback
            </a>
          </li>
          <li class="nav-items">
            <a class="nav-link" href="#">
                <i class="fa-solid fa-fire"></i> Features and Use
            </a>
          </li>
         
        </ul>
      </div>
    </nav>

  
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="main-content">
      <div class="profile-container" id="profile-container">
        <p class="h3" id="profileTitle">Your Profile Details</p>
       
        <div class="profile-details-container" id="profile-details-container">

        </div>
      </div>

      <div id="account-container">
        <p class="h3" id="accountTitle">Account</p>
        <p class="h5" id="accountSubTitle">Help you manage how other users can view your profile</p>
        <div class="account-content-container" id="account-content-container">
          <?php
            if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true) {
              $sqlMode = "SELECT public_private_profile FROM author WHERE author_id = :author_id";
            
              $result = database_run($sqlMode, array(':author_id' => $id));

              if ($result) {
                
                if (count($result) > 0) {
                  $user = $result[0];
                  $mode = $user->public_private_profile;
                  
                  if($mode === '0'){
                    echo '<p class="h5 pt-4" id="accountDescript">Your account is in public mode</p>
                    <p class="h5" id="accountDescriptAdds">This help you to show other users your credentials, if you preferred some privacy, you can change it to private mode</p>
        
                    <hr class="divider mt-5" id="accountDivider" style="margin-top: 40px">
                    <div id="changeAccountMode">
                      <button class="btn btn-primary btn-sm mt-2" id="changeModeBtn1">Change Mode to Private</button>
                    </div>';
                  }else{
                    echo '<p class="h5 pt-4" id="accountDescript">Your account is in private mode</p>
                    <p class="h5" id="accountDescriptAdds">This help you to hide your credentials to other user, if you preferred to display it in other user, you can change it to public mode</p>
        
                    <hr class="divider mt-5" id="accountDivider" style="margin-top: 40px">
                    <div id="changeAccountMode">
                      <button class="btn btn-primary btn-sm mt-2" id="changeModeBtn2">Change Mode to Public</button>
                    </div>';
                  }

                
                } else {
                  echo "Can't identify user role.";
                }
              } else {
                echo "Unable to fetch user role.";
              }
            }
          ?>
         
           
            
        </div>
      </div>

      <div id="security-container">
        <p class="h3" id="securityTitle">Security</p>
        <p class="h5" id="securitySubTitle">Security Helps you manage your account credentials</p>
        <div class="security-content-container" id="security-content-container">
          
        </div>
      </div>
     
    </main>
  </div>
</div>



    
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="jquery-3.7.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
  <script src="../JS/reusable-header.js"></script>
  <script src="../JS/user-dashboard.js"></script>
  <script src="../JS/user-account.js"></script>
  <script>
    document.getElementById('changeModeBtn1').addEventListener('click', function (event) {
    Swal.fire({
        icon: 'question',
        text: 'Switch to private mode?',
        showCancelButton: true,
        showConfirmButton: true
    }).then((result) => {
        if (result.isConfirmed) {
            var xhr = new XMLHttpRequest();

            xhr.open('POST', '../PHP/private_account.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert('Account mode changed to Private Successfully');
                    window.location.href='../PHP/user-account.php';
                }
            };

            xhr.send();
        }
    });
});
  </script>
</body>
</html>