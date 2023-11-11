$(document).ready(function() {
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
                                    window.location.href = "../php/home.php";
                                } else {
                                    window.location.href = "../php/verify.php";
                                }
                            },
                        });
                        
                    } else {
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
