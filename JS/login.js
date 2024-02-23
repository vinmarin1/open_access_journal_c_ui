document.addEventListener('DOMContentLoaded', function() {
   
    var emailInput = document.getElementById('email');
    var loginButton = document.getElementById('login-button');

   
    emailInput.addEventListener('input', function() {
    
        if (isValidEmail(emailInput.value)) {
          
            loginButton.removeAttribute('disabled');
        } else {
          
            loginButton.setAttribute('disabled', 'disabled');
        }
    });

 
    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

        // Fill email and password from URL if available
        const urlParams = new URLSearchParams(window.location.search);
        const emailFromURL = urlParams.get('email');
        const passwordFromURL = urlParams.get('password');
    
        if (emailFromURL && passwordFromURL) {
            $('#email').val(emailFromURL);
            $('#password').val(passwordFromURL);
            // Call the login function directly
            login();
        } else {
            emailInput.removeAttribute('disabled'); 
        }
    });
    
    function login() {
        const email = $("#email").val().trim();
        const password = $("#password").val().trim();
    
        if (email === "" || password === "") {
            Swal.fire({
                icon: "warning",
                title: "Ooops...",
                text: "Email and Password are required",
                customClass: {
                    container: "custom-swal"
                },
                width: 350,
                height: true,
            });
            $('#login-spinner').hide();
            $('#logging-in-text').hide();
            $('#login-text').show();
            $('#register-button').prop('disabled', false);
        } else {
            $.ajax({
                type: "POST",
                url: "../PHP/functions.php",
                data: {
                    email: email,
                    password: password,
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.success) {
                        $('#logging-in-text').text('Logging in...');
                        $('#logging-in-text').show();
                        $('#login-text').hide();
                        $('#login-spinner').show();
                        $.ajax({
                            type: "POST",
                            url: "../PHP/functions.php", // Change the URL to the correct endpoint
                            data: {
                                action: "check_verified",
                                email: email, // Include the user's email
                                password: password, // Include the user's password
                            },
                            success: function(verifiedResponse) {
                                if (verifiedResponse === "true") {
                                    window.location.href = "../PHP/author-dashboard.php";
                                } else {
                                    window.location.href = "../PHP/verify.php";
                                    setTimeout(function() {
                                        $('#logging-in-text').hide();
                                        $('#login-spinner').hide();
                                        $('#login-text').show();
                                    }, 5000);
                                }
                            },
                        });
                    } else {
                        $('#login-spinner').hide();
                        $('#logging-in-text').hide();
                        $('#login-text').show();
                        $('#register-button').prop('disabled', false);
    
                        failedAttempts++;
                        if (failedAttempts >= 3) {
                            var remainingSeconds = 60;
                            disableLoginTimer = setInterval(function() {
                                var countDownValue = Math.ceil(remainingSeconds);
                                $('#countDown').text('Account disabled. Try again in ' + countDownValue + ' seconds');
                                $('#email').prop('disabled', true);
                                $('#password').prop('disabled', true);
                                $('#login-button').prop('disabled', true);
    
                                $.ajax({
                                    type: "POST",
                                    url: "attemp_login_email.php",
                                    data: {
                                        email: $('#email').val()
                                    },
                                    success: function(response) {
                                        console.log("Email sent successfully");
                                    },
                                    error: function(error) {
                                        console.error("Error sending email");
                                    }
                                });
    
                                if (remainingSeconds <= 0) {
                                    clearInterval(disableLoginTimer);
                                    $('#countDown').text('');
                                    $('#email').prop('disabled', false);
                                    $('#password').prop('disabled', false);
                                    $('#login-button').prop('disabled', true);
                                    failedAttempts = 0;
                                }
                                remainingSeconds--;
                            }, 1000);
                        }
    
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: data.error,
                            customClass: {
                                container: "custom-swal"
                            },
                            width: 350,
                            height: true,
                        });
                    }
                }
            });
        }
    }

$(document).ready(function() {
    const spinner = document.getElementById('spinner');
    const forgotPasswordLink = document.getElementById('forgotPasswordLink');
    var failedAttempts = 0;
    var disableLoginTimer;

    forgotPasswordLink.addEventListener('click', function (event) {
     
        event.preventDefault();

        spinner.style.display = 'inline-block';

        setTimeout(function () {
          
            spinner.style.display = 'none';

            window.location.href = '../PHP/recover_account.php';
        }, 1000);
    });

    // Click event for the login button
    $('#login-button').on('click', function() {
        $('#login-text').hide();
        $('#login-spinner').show();
        $('#register-button').prop('disabled', true);
    });

    $("#form").on("submit", function(event) {
        event.preventDefault();

        const email = $("#email").val().trim();
        const password = $("#password").val().trim();

        if (email === "" || password === "") {
            Swal.fire({
                icon: "warning",
                title: "Ooops...",
                text: "Email and Password are required",
                customClass: {
                    container: "custom-swal"
                },
                width: 350,
                height: true,
            });
            $('#login-spinner').hide();
            $('#logging-in-text').hide();
            $('#login-text').show();
            $('#register-button').prop('disabled', false);
        } else {
            $.ajax({
                type: "POST",
                url: "../PHP/functions.php",
                data: {
                    email: email,
                    password: password,
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.success) {
                        $('#logging-in-text').text('Logging in...');
                        $('#logging-in-text').show();
                        $('#login-spinner').show();
                        $.ajax({
                            type: "POST",
                            url: "../PHP/functions.php", // Change the URL to the correct endpoint
                            data: {
                                action: "check_verified",
                                email: email, // Include the user's email
                                password: password, // Include the user's password
                            },
                            success: function (verifiedResponse) {
                                if (verifiedResponse === "true") {
                                    window.location.href = "../PHP/author-dashboard.php";
                                } else {
                                    window.location.href = "../PHP/verify.php";
                                    setTimeout(function() {
                                        $('#logging-in-text').hide();
                                        $('#login-spinner').hide();
                                        $('#login-text').show();
                                    }, 5000); 
                                }
                            },
                        });
                   
                       
                      
                       
                    } else {
                        $('#login-spinner').hide();
                        $('#logging-in-text').hide();
                        $('#login-text').show();
                        $('#register-button').prop('disabled', false);
                        
                        failedAttempts++;
                        if (failedAttempts >= 3) {
                            var remainingSeconds = 60;
                            disableLoginTimer = setInterval(function () {
                                var countDownValue = Math.ceil(remainingSeconds);
                                $('#countDown').text('Account disabled. Try again in ' + countDownValue + ' seconds');
                                $('#email').prop('disabled', true);
                                $('#password').prop('disabled', true);
                                $('#login-button').prop('disabled', true);

                               
                                $.ajax({
                                    type: "POST",
                                    url: "attemp_login_email.php",
                                    data: { email: $('#email').val() }, 
                                    success: function (response) {
                                        console.log("Email sent successfully");
                                    },
                                    error: function (error) {
                                        console.error("Error sending email");
                                    }
                                });
                        

                                if (remainingSeconds <= 0) {
                                    clearInterval(disableLoginTimer);
                                    $('#countDown').text('');
                                    $('#email').prop('disabled', false);
                                    $('#password').prop('disabled', false);
                                    $('#login-button').prop('disabled', true);
                                    failedAttempts = 0; 
                                }
                                remainingSeconds--;
                            }, 1000);
                        }

                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: data.error,
                            customClass: {
                                container: "custom-swal"
                            },
                            width: 350,
                            height: true,
                        });
                    }
                }
            });
        }
    });
});

