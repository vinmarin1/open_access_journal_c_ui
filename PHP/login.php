<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCU TIMES | LOG-IN</title>
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
        <div class="input-field ">
           <label for="email">Email:</label>
           <input type="email" class="input form-control" name="email"  id="email" >
        </div>
       
        <div class="input-field">
           <label for="password">Password:</label>
           <input type="password" class="input form-control" name="password"  id="password" >
           
        </div>
        
        <a href="">Forgot Password?</a>
        <button type="submit" class="btn btn-primary btn-sm" id="login-button">
                <span id="login-text">Login</span>
                <div class="spinner-border spinner-border-sm" role="status" id="login-spinner" hidden>
                    <span class="visually-hidden">Loading...</span>
                </div>
                <span id="logging-in-text" style="display: none;">Logging in...</span>
            </button>
        <input class="btn btn-primary btn-sm" type="button" value="Register" id="register-button" onclick="window.location.href= '../php/signup.php';">
    </form>


    
</div>



	


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/login.js"></script>

    <script>
            document.getElementById('login-button').addEventListener('click', function() {
            document.getElementById('login-text').style.display = 'none';
            document.getElementById('login-spinner').hidden = false;
        });
    </script>
</body>
</html>