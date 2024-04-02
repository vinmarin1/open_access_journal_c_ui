

function validateEmail() {
    const emailInput = document.getElementById("email").value;
    const firstStepForm = document.getElementById('firstStepForm');
    const secondStepForm = document.getElementById('secondStepForm');
    const emailInputted = document.getElementById('emailInputted');
    const spinner = document.getElementById('spinnerSpinner');
    const btnRequestLink = document.getElementById('btnRequestLink');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
    

    if (emailRegex.test(emailInput)) {
        // Show the spinner and change button text
        spinner.style.display = 'inline-block';
        btnRequestLink.innerHTML = 'Sending link...';
        sessionStorage.setItem('userEmail', emailInput);

        $.ajax({
            type: "POST",
            url: "../PHP/recover_account_functions.php",
            data: { email: emailInput },
            success: function (response) {
                alert('Please check your email');
                firstStepForm.style.display = 'none';
                secondStepForm.style.display = 'block';
                emailInputted.innerHTML = emailInput;
                emailInputted.style.color = 'blue';

                // Call the checkQueryParameter function and pass the email value
                checkQueryParameter(emailInput);
                sessionStorage.setItem('userEmail', emailInput);

            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
            complete: function () {
                // Hide the spinner and restore button text
                spinner.style.display = 'none';
                btnRequestLink.innerHTML = 'Request a reset link';
            }
        });
    } else {
        Swal.fire({
            icon: 'warning',
            text: 'Please enter a valid email address'
        });
    }
}



// document.getElementById('password').addEventListener('input', function (event) {
//     const passwordInput = event.target.value;
//     const passValidation = document.getElementById('PassValidation');

//     const hasUppercase = /[A-Z]/.test(passwordInput);
//     const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(passwordInput);
//     const hasNumber = /\d/.test(passwordInput);

//     if (passwordInput === '') {
//         passValidation.style.display = 'block';
//         passValidation.innerHTML = 'Password must not be empty';
//     } else if (!(hasUppercase && hasSpecialChar && hasNumber)) {
//         passValidation.style.display = 'block';
//         passValidation.innerHTML = 'Password must contain 1 Uppercase, 1 Special Character, and 1 Number';
//     } else {
     
//         passValidation.style.display = 'none';
//     }
// });


// document.getElementById('confirmPassword').addEventListener('input', function (event) {
//     const newPasswordInput = event.target.value;
//     const newPassValidation = document.getElementById('newPassValidation');

//     const hasUppercase = /[A-Z]/.test(newPasswordInput);
//     const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(newPasswordInput);
//     const hasNumber = /\d/.test(newPasswordInput);

//     if (newPasswordInput === '') {
//         newPassValidation.style.display = 'block';
//         newPassValidation.innerHTML = 'Password must not be empty';
//     } else if (!(hasUppercase && hasSpecialChar && hasNumber)) {
//         newPassValidation.style.display = 'block';
//         newPassValidation.innerHTML = 'Password must contain 1 Uppercase, 1 Special Character, and 1 Number';
//     } else {
     
//         newPassValidation.style.display = 'none';
//     }
// });

