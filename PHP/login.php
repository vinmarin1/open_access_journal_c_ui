<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCU PUBLICATION | HOME</title>
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include 'header.php' ?>
<?php include 'navbar.php' ?>



<div class="form-container">
    <form method="post" id="form">
        <h4>LOGIN</h4>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" required><br>
        <label for="email">Password:</label>
        <input type="password" name="password" id="password" class="form-control" required><br>
        <a href="#" >Forgot Password?</a><br>
        <div class="btns">
        <input class="btn btn-primary btn-sm" type="submit" value="Login" id="login-button">
        <input class="btn btn-success btn-sm" type="button" value="Register" id="register-button" onclick="window.location.href='signup.php';">
        </div>
      
       
    </form>
</div>


   
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
      <script src="../js/login.js"></script>
</body>
</html>