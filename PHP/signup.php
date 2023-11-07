<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCU PUBLICATION | HOME</title>
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
           <input type="text" class="input form-control" name="fname"  id="fname" required>
        </div>
        <div class="input-field">
            <label for="mdname">Middle Name:</label>
           <input type="text" class="input form-control" name="mdname"  id="mdname" required>
        </div>
        <div class="input-field">
            <label for="lname">Last Name:</label>
           <input type="text" class="input form-control" name="lname"  id="lname" required>
        </div>

        <div class="input-field ">
            <label for="email">Email:</label>
           <input type="email" class="input form-control" name="email"  id="email" required>
        </div>
       
        <div class="input-field">
            <label for="password">Password:</label>
           <input type="password" class="input form-control" name="password"  id="password" required>
        </div>
        <div class="input-field">
        <label for="genSelect">Gender:</label>

            <select name="genSelect" id="genSelect" class="form-control" required>
            <option value="">Select</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            </select>
        </div>
        <div class="input-field">
           <label for="bdate">Birthdate:</label>
           <input type="date" class="input form-control" name="bdate"  id="bdate" required>
        </div>
        <div class="input-field">
            <label for="pnumber">Phone Number:</label>
           <input type="number" class="input form-control" name="pnumber"  id="pnumber" required>
        </div>

        <div class="input-field">
            <label for="sclname">School Name: </label>
           <input type="text" class="input form-control" name="sclname"  id="sclname" required>
        </div>

        <div class="input-field">
            <label for="expertise">Field of Expertise: </label>
           <input type="text" class="input form-control" name="expertise"  id="expertise" required>
        </div>

        <div class="input-field">
            <label for="orcid">Orchid: </label>
           <input type="text" class="input form-control" name="orcid"  id="orcid" required>
        </div>
       
       <input type="button" value="Next" class="btn btn-primary btn-sm">
        
       </form>
   </div>



   
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
      <script src="../js/signup.js"></script>
</body>
</html>