$(document).ready(function() {
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
                url: "../php/functions.php",
                data: {
                    email: email,
                    password: password,
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.success) {
                        $('#logging-in-text').text('Logging in...');
                        $.ajax({
                            type: "POST",
                            url: "../php/functions.php", // Change the URL to the correct endpoint
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
                                }
                            },
                        });
                        $('#logging-in-text').show();
                        
                    } else {
                        $('#login-spinner').hide();
                        $('#logging-in-text').hide();
                        $('#login-text').show();
                        $('#register-button').prop('disabled', false);
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
