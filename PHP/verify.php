<?php

	require "../PHP/mail.php";
	require "../PHP/functions.php";
	check_login();

	// $errors = array();

	if ($_SERVER['REQUEST_METHOD'] == "GET") {
		if (!check_verified()) {
			// User is not verified, send verification email
			$_SESSION['LOGGED_IN'] = false;
			$vars['code'] =  rand(10000,99999);
			$vars['expires'] = (time() + (24 * 3));
			$vars['email'] = $_SESSION['USER']->email;

			$query = "INSERT INTO verify (code, expires, email) VALUES (:code, :expires, :email)";
			database_run($query, $vars);

			$message = "Your verification code is " . $vars['code'];
			$subject = "Email Verification";
			$recipient = $vars['email'];
			send_mail($recipient, $subject, $message);
		} else {
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
						header("Location: ../PHP/index.php");
						die;
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
    <title>QCU TIMES PUBLICATION | VERIFICATION CODE</title>
	<link rel="stylesheet" href="../CSS/verify.css">
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