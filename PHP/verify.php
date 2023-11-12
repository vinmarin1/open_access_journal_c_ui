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
			header("Location: ../php/home.php"); // User is already verified
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

					$author_id = $_SESSION['USER']->author_id;
					$query = "UPDATE author SET email_verified = email WHERE author_id  = '$author_id' limit 1";
					
					database_run($query);
					if(check_verified())
					header("Location: ../php/home.php");
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
	<link rel="stylesheet" href="../css/verify.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	
</head>
<body>

			
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