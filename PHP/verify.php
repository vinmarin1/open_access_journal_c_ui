<?php

	require "../PHP/mail.php";
	require "../PHP/functions.php";
	check_login();

	// $errors = array();

	if ($_SERVER['REQUEST_METHOD'] == "GET") {
		if (!check_verified()) {

			$timezone = new DateTimeZone('Asia/Manila');
			$current_time = new DateTime('now', $timezone);
			// $current_time->add(new DateInterval('PT50S'));  // PT10S represents 10 seconds
			$current_time->add(new DateInterval('P7D'));
			$expiration_timestamp = $current_time->getTimestamp();
			$vars['expires'] = $expiration_timestamp;
			
			
			// User is not verified, send verification email
			$_SESSION['LOGGED_IN'] = false;
			$vars['code'] =  rand(10000,99999);
			// $vars['expires'] = (time() + (24 * 3));
			$vars['email'] = $_SESSION['USER']->email;

			$query = "INSERT INTO verify (code, expires, email) VALUES (:code, :expires, :email)";
			database_run($query, $vars);

			// Construct the HTML content for the email
			$verification_code_html = '<div style="font-size: 28px; text-align: center; padding: 15px; background-color: #f0f0f0; border-radius: 8px;">' . $vars['code'] . '</div>';

			$message = '
            <div class="container" style="max-width: 600px; margin: 20px auto; background-color: #ffffff; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);">
                <div class="header" style="background-color: #0858A4; color: #ffffff; padding: 20px; text-align: center;">
					<img class="img-logo" src="https://qcuj.online/images/pahina-final.png" alt="" style="width: 50px;">
				<h1 style="color: #fff; text-align: center; margin-bottom: 10px;">Email Verification</h1>
                </div>
                <div class="container-body" style="padding: 20px; text-align: left;">
                    <p>Welcome to <span style="color: #0858A4;">Pahina</span>! To ensure the security of your account, please verify your email address by using the code below:</p>
                    ' . $verification_code_html . '
                    <p style="font-style: italic; color: #777777; text-align: left; margin-bottom: 20px;">This code is valid for a limited time.</p>
                    <p style="margin-bottom: 15px; color: #555555; text-align: left; line-height: 1.4;">Please enter the code on the login page to complete the verification process.</p>
                </div>
                <div class="footer" style="text-align: center; color: #888888; font-size: 14px; margin-top: 20px;">
                    <p>Need help? <a href="mailto:qcujournal@gmail.com" style="color: #0858A4;">qcujournal@gmail.com</a> or visit our <a href="#" style="color: #0858A4;">Help Center</a>.</p>
                </div>
            </div>
			';
			$subject = "Email Verification";
			$recipient = $vars['email'];
			send_mail($recipient, $subject, $message);
		} else {
			$_SESSION['LOGGED_IN'] = true;
			$urli = $_SESSION['USER']->urli;
			if (!empty($urli)) {
				header("Location: " . $urli);
				die;
			} else {
				header("Location: ../PHP/index.php");
				die;
			}
		}
	}

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if (!check_verified()) {
			$vars['email'] = $_SESSION['USER']->email;
			$vars['code'] = $_POST['code'];
			$query = "SELECT * FROM verify WHERE code = :code AND email = :email";
			$row = database_run($query, $vars);
	
			if (is_array($row)) {
				$row = $row[0];
				$time = time();
	
				if ($row->expires > $time) {
					$author_id = $_SESSION['USER']->author_id;
					$admin_id = $_SESSION['USER']->admin_id;
					$urli = $_SESSION['USER']->urli;
	
					// Update the email_verified field for the author
					$query_author = "UPDATE author SET email_verified = email WHERE author_id = :author_id LIMIT 1";
					$params_author = array('author_id' => $author_id);
					database_run($query_author, $params_author);
	
					// Update the email_verified field for the admin
					$query_admin = "UPDATE admin SET email_verified = email WHERE admin_id = :admin_id LIMIT 1";
					$params_admin = array('admin_id' => $admin_id);
					database_run($query_admin, $params_admin);
	
					if (check_verified()) {
						$_SESSION['LOGGED_IN'] = true;
							$urli = $_SESSION['USER']->urli;
						if (!empty($urli)) {
							header("Location: " . $urli);
							die;
						} else {
							header("Location: ../PHP/index.php");
							die;
						}
					} elseif (check_admin_verified()) {
						$_SESSION['LOGGED_IN'] = true;
							$urli = $_SESSION['USER']->urli;
							if (!empty($urli)) {
								header("Location: " . $urli);
								die;
							} else {
								header("Location: ../PHP/index.php");
								die;
							}
					} else {
						echo "Code expired";
					}
				} else {
					echo "Code expired";
				}
			} else {
				echo "";
			}
		} else {
			$_SESSION['LOGGED_IN'] = true;
			echo "You're already verified";
		}
	}
	
	function check_admin_verified() {
		$admin_id = isset($_SESSION['USER']->admin_id) ? $_SESSION['USER']->admin_id : null;
		if ($admin_id) {
			$query_admin = "SELECT * FROM admin WHERE admin_id = :admin_id AND email = email_verified LIMIT 1";
			$params_admin = array('admin_id' => $admin_id);
			$row_admin = database_run($query_admin, $params_admin);
			return is_array($row_admin) && $row_admin[0]->email == $row_admin[0]->email_verified;
		}
		return false;
	}
	
	function check_verified() {
		$author_id = isset($_SESSION['USER']->author_id) ? $_SESSION['USER']->author_id : null;
		if ($author_id) {
			$query = "SELECT * FROM author WHERE author_id = :id AND email = email_verified LIMIT 1";
			$params = array('id' => $author_id);
			$row = database_run($query, $params);
			return is_array($row) && $row[0]->email == $row[0]->email_verified;
		}
		return false;
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./meta.php'); ?>
    <title>Pahina PUBLICATION | VERIFICATION CODE</title>
	<link rel="stylesheet" href="../CSS/verify.css">
	<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	
</head>
<body>

		<?php require 'header.php' ?>	
		<form method="post" id="form">
		<p class="descript">An OTP code was sent to <span><b><?php echo $vars['email'];?></b></span></p>
		<div>
		
		</div>
			<input type="text" id="code" name="code" placeholder="Enter the 5 digit code ">
 			<br>
			 <p class="validation" id="validation">
			<?php
			if ($_SERVER['REQUEST_METHOD'] == "POST") {
				if (!check_verified()) {
					if (empty($_POST['code'])) {
						echo "*Please enter the 5-digit code sent to your email";
					} else {
						echo "";
					}
				}
			}
			?>
			</p>

			<br>
			<input type="button" id="verifyBtn" class="btn btn-primary btn-sm" value="Verify">
		</form>
	


	


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../JS/reusable-header_footer.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
        const codeInput = document.getElementById('code');
        const verifyBtn = document.getElementById('verifyBtn');
		const form = document.getElementById('form');

        verifyBtn.addEventListener('click', function () {
            const codeValue = codeInput.value;

            if (codeValue === '') {
               Swal.fire({
				icon: 'warning',
				text: 'Please enter the OTP CODE'
			   });
            } else if (codeValue.length <= 4) {
                Swal.fire({
				icon: 'warning',
				text: 'Invalid OTP Code, Please Try again'
			   });
            } else {
                form.submit();
            }
        });

        codeInput.addEventListener('input', function () {
            let sanitizedValue = this.value.replace(/\D/g, '');
            sanitizedValue = sanitizedValue.slice(0, 5);
            this.value = sanitizedValue;
        });
    });
</script>
</body>
</html>