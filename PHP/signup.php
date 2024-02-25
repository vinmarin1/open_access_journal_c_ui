<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./meta.php'); ?>
    <title>QCU PUBLICATION | SIGN-UP</title>
    <link rel="stylesheet" href="../CSS/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
</head>
<body>

<?php include 'header.php' ?>
<?php include 'navbar.php' ?>

<div class="form-container">
	
    <form method="POST" id="form" action="signup-function.php">
      

       <p class="h4 mt-4">REGISTER</p>
       <div class="input-field pt-5">
           <label for="email">Email:</label><span id="span1">*</span><span id="spanEmailValidation" style="display: none; color: red; font-size: 11px">Invalid email</span>
           <input type="email" class="input form-control" name="email"  id="email">
        </div>
        <div class="input-field">
            <label for="orcid">ORCID:</label> <span id="orcidVlalidation">*</span><span class="text-muted" style="font-size:12px; font-weight:bold;" id="span6">  </span><span id="spanOrcidValidation" style="display: none; color: red; font-size: 11px">Orcid invalid</span>
            <span class="d-block text-muted" style="font-size:12px">If you do not have an ORCID, <a class="text-reset" href="https://orcid.org/register">register here</a></span>
           <input type="text" class="input form-control" name="orcid"  id="orcid" placeholder="Example: xxxx-xxxx-xxxx-xxxx">
        </div>

       <div class="input-field ">
           <label for="fname">First Name:</label><span id="span2">*</span></span><span id="spanFnameValidation" style="display: none; color: red; font-size: 11px">First name should be at least 2 characters</span>
           <input type="text" class="input form-control" name="fname"  id="fname" >
        </div>
        <div class="input-field">
            <label for="mdname">Middle Name: </label><span id="spanMdValidation" style="display: none; color: red; font-size: 11px">Middle name should be at least 2 characters</span>
           <input type="text" class="input form-control" name="mdname"  id="mdname" >
        </div>
        <div class="input-field">
            <label for="lname">Last Name:</label><span id="span4">*</span><span id="spanLnValidation" style="display: none; color: red; font-size: 11px">Last name should be at least 2 characters</span>
           <input type="text" class="input form-control" name="lname"  id="lname" >
        </div>

    
       
        <div class="input-field">
            <label for="password">Password:</label><span id="span5">*</span><span id="spanPasswordValidation" style="display: none; color: red; font-size: 11px">Password should at least contain 1 Uppercase 1 Special Character and 1 Number</span>
           <input type="password" class="input form-control" name="password"  id="password" >
        </div>
      
      <div class="fluid-container" id="footer-form">
     
      <button type="button" class="btn btn-outline-primary btn-sm" id="privacyBtn"  data-bs-toggle="modal" data-bs-target="#exampleModal">Check Privacy</button>
      <input type="submit" value="Register" class="btn btn-primary btn-sm" id="signUpBtn">

      </div>

      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mt-2">
              <div class="mt-1" id="firstP">
              PRIVACY POLICY
              This privacy describe our policies and procedure on the collection, use and disclosure of your Information when you use the Quezon City University Journals.
              </div>
              <div class="mt-4" id="secondP">
              We use your personal data to provide and  improve the service. By using the service, you agree to the collection and use of information in accordance with this privacy.
              
           
              </div>
              <div class="mt-4">
              WHAT INFORMATION DO WE COLLECT?
              </div>
              <div class="mt-4" id="thirdP">
              In this Privacy Policy, your "personal information" means information that could allow you to be identified. This typically includes information such as your name, address, username, profile picture, email address, ORCID and phone number.
              </div>

            </div>
            <div class="modal-footer">
          
              <input type="checkbox" class="form-check" name="privacyPolicy" name="privacyPolicy" id="privacyPolicy" value="1" disabled>
              <button type="button"  class="btn btn-primary btn-sm" id="btn-agree" disabled>I Agree</button>
              <!-- <p id="privacyStatement" style="font-size: 15px">I've read and agree with the terms and privacy of the website.</p> -->
            </div>
          </div>
        </div>
      </div>
              

    </form>
</div>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="../JS/signup.js"></script>
</body>
</html>