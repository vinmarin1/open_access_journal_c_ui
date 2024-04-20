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
            <div class="container" style="max-width: 600px; margin: 20px auto; font-family: Arial, sans-serif; border: 1px solid #ccc; border-radius: 8px; overflow: hidden;">
                <div class="header" style="background-color: #0858A4; color: #ffffff; padding: 20px; text-align: center;">
					<img class="img-logo" src="https://qcuj.online/images/qcu-icon-final.png" alt="" style="width: 60px;">
					<h1 style="color: #fff; text-align: center; margin-bottom: 10px;">Email Verification</h1>
                </div>
                <div class="container-body" style="padding: 20px; text-align: left;">
                    <p>Welcome to <span style="color: #0858A4;">QCUJ</span>! To ensure the security of your account, please verify your email address by using the code below:</p>
                    ' . $verification_code_html . '
                    <p style="font-style: italic; color: #777777; text-align: left; margin-bottom: 20px;">This code is valid for a limited time.</p>
                    <p style="margin-bottom: 15px; color: #555555; text-align: left; line-height: 1.4;">Please enter the code on the login page to complete the verification process.</p>
                </div>
                <div class="footer" style="background-color: #f0f0f0; padding: 10px; text-align: center;">
                    <p style="font-size: 14px; color: #666; margin-bottom: 10px;">Need help? <a href="mailto:qcujournal@gmail.com" style="color: #0858A4;">qcujournal@gmail.com</a> or visit our <a href="https://www.qcuj.online/PHP/contact-us.php" style="color: #0858A4;">Help Center</a>.</p>
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
    <title>QCUJ PUBLICATION | VERIFICATION CODE</title>
	<link rel="stylesheet" href="../CSS/verify.css">
	<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	
</head>
<body>

		
	<header class="header-container" id="header-container">
	</header>
	<div class="form-container">
		<img src="../images/qcu-bg.jpg" class="image-cover">
		<div class="verification-container">
			<header class="header-container" id="header-container"></header>
			<div class="verification-content">
				<h1 class="verification-title">Email Verification</h1>
				<p class="verification-description">An OTP code was sent to <span class="email-address"><?php echo $vars['email'];?></span></p>
				<p id="timerDisplay" style="text-align: center; color: red; margin-top: -19px;">Time remaining: 1:00</p>
				<input type="hidden" id="sentOTP" value="<?php echo $vars['code']; ?>">
				<form method="post" id="form" class="verification-form">
					<input type="text" id="code" name="code" placeholder="Enter the 5-digit code" class="form-control">
					<p class="validation" id="validation"></p>
					<button type="button" id="verifyBtn" class="btn btn-primary">Verify</button>
				</form>
			</div>
		</div>
	</div>
	
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function showAlert() {
	Swal.fire({
	icon: 'info',
	title: 'Profile Incomplete',
	text: 'Please complete the required details in profile to submit article'
	});
}
</script>
<script src="../JS/reusable-header.js"></script>
<script src="../JS/reusable-header_footer.js"></script>

<script>

	
document.addEventListener('DOMContentLoaded', function () {
    const codeInput = document.getElementById('code');
    const verifyBtn = document.getElementById('verifyBtn');
    const form = document.getElementById('form');
    const sentOTP = document.getElementById('sentOTP').value;
    const timerDisplay = document.getElementById('timerDisplay');

    let timerSeconds = 60; 
    let timerInterval;

	function updateTimerDisplay() {
        const minutes = Math.floor(timerSeconds / 60);
        const seconds = timerSeconds % 60;
        timerDisplay.textContent = `Time remaining: ${minutes}:${seconds.toString().padStart(2, '0')}`;

        if (timerSeconds === 0) {
            clearInterval(timerInterval);
            codeInput.disabled = true;
            verifyBtn.disabled = true;
            Swal.fire({
                icon: 'info',
                text: 'OTP expired, Please request a new one'
            });
        }
    }

	document.getElementById('code').addEventListener('input', function(event) {
    let input = event.target.value;
    
   
    input = input.replace(/\D/g, '');

  
    if (input.length > 5) {
        input = input.slice(0, 5);
    }

 
    event.target.value = input;
});
    // Start the timer countdown
    function startTimer() {
        timerInterval = setInterval(function () {
            if (timerSeconds > 0) {
                timerSeconds--;
                updateTimerDisplay();
            } else {
                clearInterval(timerInterval);
                // Disable OTP input after 1 minute
                codeInput.disabled = true;
                Swal.fire({
                    icon: 'info',
                    text: 'OTP expired, Please request a new one'
                });
            }
        }, 1000); // Update every second
    }

    // Call startTimer when the page loads
    startTimer();

    // Event listener for OTP verification
    verifyBtn.addEventListener('click', function () {
        const codeValue = codeInput.value;

        if (codeValue === '') {
            Swal.fire({
                icon: 'warning',
                text: 'Please enter the OTP CODE'
            });
        } else if (codeValue !== sentOTP) {
            Swal.fire({
                icon: 'warning',
                text: 'Wrong OTP Code, Please try again'
            });
        } else {
           
            form.submit();
        }
    });

  
    codeInput.addEventListener('focus', function () {
        if (!timerInterval) { 
            timerSeconds = 60; 
            updateTimerDisplay();
			
        }
    });

  
    form.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault(); 
        }
    });
});

</script>
</body>
</html>

