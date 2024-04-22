
document.addEventListener('DOMContentLoaded', function () {
    const codeInput = document.getElementById('code');
    const verifyBtn = document.getElementById('verifyBtn');
    const form = document.getElementById('form');
    const sentOTP = document.getElementById('sentOTP').value;
    const timerDisplay = document.getElementById('timerDisplay');
    const resendBtn = document.getElementById('resendBtn');
    let timerSeconds = 300; // 5 minutes in seconds
    let timerInterval;
    resendBtn.disabled = true;

    resendBtn.addEventListener('click', function (event) {
        Swal.fire({
            icon: 'success',
            text: 'Resend OTP Successfully, Please wait a moment'
        });
        const xhr = new XMLHttpRequest();
        xhr.open('GET', window.location.href, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                document.open();
                document.write(xhr.responseText);
                document.close();
            }
        };
        xhr.send();
    });

    function updateTimerDisplay() {
        const minutes = Math.floor(timerSeconds / 60);
        const seconds = timerSeconds % 60;
        timerDisplay.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

        if (timerSeconds === 0) {
            clearInterval(timerInterval);
            codeInput.disabled = true;
            verifyBtn.disabled = true;
            resendBtn.disabled = false;
            Swal.fire({
                icon: 'info',
                text: 'OTP expired, Please request a new one'
            });
        }
    }

    document.getElementById('code').addEventListener('input', function (event) {
        let input = event.target.value;
        input = input.replace(/\D/g, '');
        if (input.length > 5) {
            input = input.slice(0, 5);
        }
        event.target.value = input;
    });

    function startTimer() {
        timerInterval = setInterval(function () {
            if (timerSeconds > 0) {
                timerSeconds--;
                updateTimerDisplay();
            } else {
                clearInterval(timerInterval);
                codeInput.disabled = true;
                Swal.fire({
                    icon: 'info',
                    text: 'OTP expired, Please request a new one'
                });
            }
        }, 1000); // Update every second
    }

    startTimer(); // Start the timer countdown

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
            timerSeconds = 300; // Reset timer to 5 minutes when input is focused
            updateTimerDisplay();
        }
    });

    form.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
        }
    });
});
