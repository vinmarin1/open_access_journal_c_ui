<!-- <?php

	require "../php/mail.php";
	require "../php/functions.php";
	check_login();

	$errors = array();

	if($_SERVER['REQUEST_METHOD'] == "GET" ){
		if(!check_verified()){

			//send email
			$vars['code'] =  rand(10000,99999);
	
			//save to database
			$vars['expires'] = (time() + (24 * 3));
			$vars['email'] = $_SESSION['USER']->email;
	
			$query = "insert into verify (code,expires,email) values (:code,:expires,:email)";
			database_run($query,$vars);
	
			$message = "your code is " . $vars['code'];
			$subject = "Email verification";
			$recipient = $vars['email'];
			send_mail($recipient,$subject,$message);
		}else {
			header("Location: ../php/timeline.php"); // User is already verified
			die;
		}
	}

	if($_SERVER['REQUEST_METHOD'] == "POST"){

		if(!check_verified()){

		
			$query = "select * from verify where code = :code && email = :email";
			$vars = array();
			$vars['email'] = $_SESSION['USER']->email;
			$vars['code'] = $_POST['code'];

			$row = database_run($query,$vars);

			if(is_array($row)){
				$row = $row[0];
				$time = time();

				if($row->expires > $time){

					$id = $_SESSION['USER']->id;
					$query = "update users set email_verified = email where id = '$id' limit 1";
					
					database_run($query);
					if(check_verified())
					header("Location: ../php/timeline.php");
					die;
				}else{
					echo "Code expired";
				}

			}else{
				echo "Code Incorrect";
			}
		}else{
			echo "You're already verified";
		}
	}

?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCU TIMES PUBLICATION | VERIFICATION CODE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		form{
   width: 350px;
   border: none;
   height: auto;
   box-shadow:  0 20px 20px rgba(0, 0, 0, 0.1);
   margin-left: auto;
   margin-right: auto;
   margin-top: 80px;
   padding-top: 5px;
}



.descript{
	text-align: center;
	margin-bottom: 40px;
}

.descript, input[type="text"], input[type="submit"]{
	margin-left: auto;
	margin-right: auto;
	width: 90%;
    height: 35px;
    padding-left: 10px;
    outline: none;
	margin-left: 20px;
	

}

.descript{
	font-size: 20px;
	margin-top: 40px;
	
}

.descript span{
	font-size: 15px;
	
	
}
input[type="text"]{
	margin-top: 20px;
	text-align: center;
}


input[type="text"]:focus{
	outline: 1px solid;
	
}

.validation{
	color: red;
	text-align: center;
	margin-top: 10px;
	margin-bottom: -30px;
}


input[type="submit"]{
	margin-bottom: 40px;
}

	</style>
</head>
<body>
<div class="header-container" id="header-container">
        <!-- header will be display here by fetching reusable files -->
      </div>
      
      <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark" id="navigation-menus-container">
        <!-- navigation menus will be display here by fetching reusable files -->
      </nav>
 	<div>
	
			
		<form method="post">
		<p class="descript">An OTP code was sent to <span><b><?php echo $vars['email'];?></b></span></p>
		<div>
		
		</div>
			<input type="text" name="code" placeholder="Enter the 5 digit code ">
 			<br>
			 <p class="validation" id="validation">
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (!check_verified()) {
            if (empty($_POST['code'])) {
                echo "*Please enter the 5-digit code sent to your email";
            } else {
                echo "Code Incorrect";
            }
        }
    }
    ?>
</p>

			<br>
			<input class="btn btn-primary btn-sm" type="submit" value="Verify">
		</form>
	


	


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="../JS/reusable-header_footer.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>