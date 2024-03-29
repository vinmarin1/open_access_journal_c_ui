<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./meta.php'); ?>
    <title>PAHINA | RECOVERY ACCOUNT</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400&display=swap">
    <link href="../CSS/recover_account.css" rel="stylesheet">
</head>
<body>

<?php require 'header.php' ?>

    <div class="container-fluid">
        <div id="firstStep" class="firstStep">
            <form id="firstStepForm">
                <p class="h2 pt-5">Forgot password?</p><br>
                <div class="emailContainer">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control mt-1" id="email" name="email">
                    <button type="button" id="btnRequestLink" class="btn btn-primary btn-sm mt-3" onclick="validateEmail()">Request a reset link
                        <div class="spinner-border spinner-border-sm" id="spinnerSpinner" role="status" style="display: none">
                            <span class="visually-hidden" id="spinner">Loading...</span>
                        </div>
                    </button>
                </div>  
            </form>
        </div>

        <div id="secondStep" class="secondStep">
            <form id="secondStepForm">
                <p class="h2 pt-5">Email sent</p>
                <p class="h6 pt-5">We sent an email to <span id="emailInputted"></span> with a link to reset your password</p>
            </form>
        </div>


        <div id="thirdStep">
            <form id="thirdStepForm">
                <p class="h2 pt-5">Change password</p>
                <div class="inputContainer">
                    
                 
                    <label class="pt-4" for="password">New password</label>
                    <span class="validationPassword" id="PassValidation" style="font-size: 10px; color: red; display: block; margin-left: 40px"></span>

                    <input type="password" class="form-control mt-1" id="password" name="password">
                    <label class="pt-4" for="confirmPassword">Confirm password</label>
                    <span class="validationPassword" id="newPassValidation" style="font-size: 10px; color: red; display: block; margin-left: 40px" ></span>
                    <input type="password" class="form-control mt-1" id="confirmPassword" name="confirmPassword">
                    <button type="button" id="changePasswordBtn" class="btn btn-primary btn-sm mt-3">Change Password
                        <div class="spinner-border spinner-border-sm" id="spinnerSpinner2" role="status" style="display: none">
                            <span class="visually-hidden" id="spinner2">Updating your password...</span>
                        </div>
                    </button>
                 </div>  
            </form>
          
        </div>

        <div id="finalStep">
            <form id="finalStepForm">
                <p class="h2 pt-4">Password changed</p>
                <p class="h6 pt-4">Your password has been successfuly changed.</p>
                <button type="button" class="btn btn-primary btn-sm mt-3" onclick="window.location.href='https://www.qcuj.online/PHP/login.php'">Log-in</button>

            </form>
          
        </div>

        
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="../JS/recover_account.js"></script>
    <script>
function checkQueryParameter() {
    const urlParams = new URLSearchParams(window.location.search);
    const step = urlParams.get('step');
    const thirdStepForm = document.getElementById('thirdStepForm');

    if (step === '3') {
        // Check if the link has been used by looking at the localStorage
        const linkUsed = localStorage.getItem('resetLinkUsed');

        if (linkUsed === null) {
            // If the link hasn't been used, proceed
            const storedEmail = '<?php echo isset($_SESSION['userEmail']) ? $_SESSION['userEmail'] : "" ?>';

            if (storedEmail) {
                // Display the stored email
                alert('Updating account of: ' + storedEmail);
            } else {
                // Handle the case where the email is not found
                alert('Email not found');
            }

            thirdStepForm.style.display = 'block';
            document.getElementById('firstStepForm').style.display = 'none';
            document.getElementById('secondStepForm').style.display = 'none';

            // Mark the link as used by setting a flag in localStorage
            localStorage.setItem('resetLinkUsed', 'true');
        } else {
            // Handle the case where the link has already been used
            alert('Link expired. Please request a new link.');
            resetLinkStatus(); // Reset the link status for a new link
            window.location.href= '../PHP/login.php';
        }
    }
}

function resetLinkStatus() {
    // Reset the link status by removing the 'resetLinkUsed' flag from localStorage
    localStorage.removeItem('resetLinkUsed');
}

window.addEventListener('load', checkQueryParameter);



document.getElementById('changePasswordBtn').addEventListener('click', function (event) {
    const emailInput = document.getElementById('email');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');
    const thirdStepForm = document.getElementById('thirdStepForm');
    const finalStepForm = document.getElementById('finalStepForm');
    const spinnerSpinner2 = document.getElementById('spinnerSpinner2');
    const changePasswordBtn = document.getElementById('changePasswordBtn');

    const storedEmail = '<?php echo isset($_SESSION['userEmail']) ? $_SESSION['userEmail'] : "" ?>';

    if (password.value === '' && confirmPassword.value === '') {
        Swal.fire({
            icon: 'warning',
            text: 'Please provide a password'
        });
    } else if (password.value === '') {
        Swal.fire({
            icon: 'warning',
            text: 'Please provide a password to recover your account'
        });
    } else if (confirmPassword.value === '') {
        Swal.fire({
            icon: 'warning',
            text: 'Confirm your password'
        });
    } else if (!(password.value === confirmPassword.value)) {
        Swal.fire({
            icon: 'warning',
            text: 'Password does not match'
        });
    } else {
        spinnerSpinner2.style.display = 'block';
        changePasswordBtn.innerHTML = 'Changing your password...';
        $.ajax({
            type: "POST",
            url: "../PHP/reset_pass.php",
            data: { email: storedEmail, password: password.value }, // Use password.value to get the actual password
            success: function (response) {
                alert('Successfully change your password');
                firstStepForm.style.display = 'none';
                secondStepForm.style.display = 'none';
                thirdStepForm.style.display = 'none';
                finalStepForm.style.display = 'block';
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
            complete: function () {
                // Hide the spinner and restore button text
                spinnerSpinner2.style.display = 'none';
                changePasswordBtn.innerHTML = 'Change Password';
            }
        });
    }
});

    </script>
</body>
</html>