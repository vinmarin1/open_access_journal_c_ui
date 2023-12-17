<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCU PUBLICATION | SIGN-UP</title>
    <link rel="stylesheet" href="../CSS/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
</head>
<body>

<?php include 'header.php' ?>
<?php include 'navbar.php' ?>

<div class="form-container">
	
    <form method="post" id="form">
      

       <p class="h4 mt-4">REGISTER</p>
       <div class="input-field pt-5">
           <label for="fname">First Name:</label>
           <input type="text" class="input form-control" name="fname"  id="fname" >
        </div>
        <div class="input-field">
            <label for="mdname">Middle Name:</label>
           <input type="text" class="input form-control" name="mdname"  id="mdname" >
        </div>
        <div class="input-field">
            <label for="lname">Last Name:</label>
           <input type="text" class="input form-control" name="lname"  id="lname" >
        </div>

        <div class="input-field ">
           <label for="email">Email:</label>
           <input type="email" class="input form-control" name="email"  id="email" >
        </div>
       
        <div class="input-field">
            <label for="password">Password:</label>
           <input type="password" class="input form-control" name="password"  id="password" >
        </div>
        <div class="input-field">
        <label for="genSelect" name="gendSelect" id ="gendSelect">Gender:</label>

            <select name="genSelect" id="genSelect" class="form-control" >
            <option value="Select">Select</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            </select>
        </div>
        <div class="input-field">
           <label for="bdate">Birthdate:</label>
           <input type="date" class="input form-control" name="bdate"  id="bdate" >
        </div>
        
        <div class="input-field">
            <label for="pnumber">Phone Number:</label>
           <input type="number" class="input form-control" name="pnumber"  id="pnumber" >
        </div>

        <div class="input-field">
            <label for="afiliations">Afiliations: </label>
           <input type="text" class="input form-control" name="afiliations"  id="afiliations" >
        </div>

        <div class="input-field">
            <label for="position">Position: </label>
           <input type="text" class="input form-control" name="position"  id="position" >
        </div>

        <div class="input-field">
            <label for="expertise">Field of Expertise: </label>
           <input type="text" class="input form-control" name="expertise"  id="expertise" >
        </div>

        <div class="input-field">
            <label for="bio">Bio: </label>
           <input type="text" class="input form-control" name="bio"  id="bio" >
        </div>

        <div class="input-field">
            <label for="orcid">ORCID ID: </label>
           <input type="text" class="input form-control" name="orcid"  id="orcid" >
        </div>

        <div class="input-field">
            <label for="country">Country: </label>
            <select class="form-select" name="country" id="country"></select>
        </div>
        <div class="fluid-container">
     
      <input type="checkbox" class="form-check" name="privacyPolicy" id="privacyPolicy" style="display: inline-block; margin-left: 10px;">
        <p  style="display: inline-block;position: absolute; margin-left: 10px; text-decoration: underline; color: #0858a4">Privacy</p>
      <input type="submit" value="Register" class="btn btn-primary btn-sm" id="signUpBtn">
      </div>
    </form>
</div>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="../JS/signup.js"></script>
</body>
</html>