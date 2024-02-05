$(document).ready(function() {
    $("#sendBtn").on("click", function() {
        var email = $("#email").val();

        $(this).prop("disabled", true);
        $("#spinner").show();

        $.ajax({
            type: "POST",
            url: "recover_account_functions.php",
            data: { email: email },
            success: function(response) {
                $("#sendBtn").prop("disabled", false);

                setTimeout(function() {
                    $("#spinner").hide();

                    if (response === 'success') {
                        $("#step1Label").hide();
                        $("#step2Label").show();
                        $("#getEmail").text(email);
                        $("#firstStep").hide();
                        $("#secondStep").show();
                    } else {
                        alert('Error: ' + response);
                    }
                }, 3000);
            },
            error: function() {
                $("#sendBtn").prop("disabled", false);

                setTimeout(function() {
                    $("#spinner").hide();
                    alert('AJAX request failed.');
                }, 3000);
            }
        });
    });

  
    $("#email").on("input", function() {
        var email = $("#email").val();
        // Use a simple email validation regex
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    
        $("#sendBtn").prop("disabled", !emailRegex.test(email));
    });

    $("#otp").on("input", function() {
        var otp = $("#otp").val();
      
        var isFiveDigitNumber = /^\d{5}$/.test(otp);

  
        $("#otpBtn").prop("disabled", !isFiveDigitNumber);
    });

    $("#form").on("submit", function(e) {
        e.preventDefault();

        var otp = $("#otp").val();

        $.ajax({
            type: "POST",
            url: "check_otp_expiry.php",
            data: { otp: otp },
            success: function(response) {
                if (response === 'expired') {
                    alert("The OTP you entered has expired. Please try again.");
                } else {
                    alert("Entered OTP: " + otp);
                }
            },
            error: function() {
                alert('Error checking OTP expiry.');
            }
        });
    });
});



var otpInput = document.getElementById("otp");

otpInput.addEventListener("input", function() {
 
    this.value = this.value.replace(/\D/g, '');
});