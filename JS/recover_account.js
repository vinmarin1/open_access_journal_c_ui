function validateEmail(email, emailR) {
    if (email === '') {
        emailR.style.display = 'inline-block';
        emailR.textContent = 'Invalid email';
    } else {
        const emailRegex = /^\S+@\S+\.\S+$/;
        if (!emailRegex.test(email)) {
            emailR.style.display = 'inline-block';
            emailR.textContent = 'Invalid email';
        } else {
            emailR.style.display = 'none';
        }
    }
}


function validatePassword(password, passwordR) {
    if (password === '') {
        passwordR.style.display = 'inline-block';
        passwordR.textContent = 'Password must contain at least 1 Uppercase, 1 Special Character, and 1 Number';
    } else {
        const passwordRegex = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])/;
        if (!passwordRegex.test(password)) {
            passwordR.style.display = 'inline-block';
            passwordR.textContent = 'Password must contain at least 1 Uppercase, 1 Special Character, and 1 Number';
        } else {
            passwordR.style.display = 'none';
        }
    }
}


document.getElementById('email').addEventListener('input', function () {
    const email = this.value;
    const emailR = document.getElementById('emailR');
    validateEmail(email, emailR);
});

document.getElementById('password').addEventListener('input', function () {
    const password = this.value;
    const passwordR = document.getElementById('passwordR');
    validatePassword(password, passwordR);
});

document.getElementById('nPassword').addEventListener('input', function () {
    const nPassword = this.value;
    const nPasswordR = document.getElementById('nPasswordR');
    validatePassword(nPassword, nPasswordR);
});

document.getElementById('cPassword').addEventListener('input', function () {
    const cPassword = this.value;
    const cPasswordR = document.getElementById('cPasswordR');
    validatePassword(cPassword, cPasswordR);
});


document.getElementById('sendBtn').addEventListener('click', function (event) {
    const sendBtn = document.getElementById('sendBtn').value;
    const spinner = document.getElementById('spinner').value;

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const nPassword = document.getElementById('nPassword').value;
    const cPassword = document.getElementById('cPassword').value;

    const emailR = document.getElementById('emailR');
    const passwordR = document.getElementById('passwordR');
    const nPasswordR = document.getElementById('nPasswordR');
    const cPasswordR = document.getElementById('cPasswordR');


    validateEmail(email, emailR);
    validatePassword(password, passwordR);
    validatePassword(nPassword, nPasswordR);
    validatePassword(cPassword, cPasswordR);

    if (cPassword !== nPassword || nPassword !== cPassword) {
        Swal.fire({
            icon: 'warning',
            title: 'Password mismatch',
            text: 'New password and confirm password do not match, please try again'
        });
    }else{
        sendBtn.innerText = '';
        document.getElementById('spinner').style.display = 'inline-block'; 
        document.getElementById('otpSending').style.display = 'inline-block'; 
        setTimeout(function () {
            document.getElementById('spinner').style.display = 'none';
            document.getElementById('otpSending').style.display = 'none';
        }, 2000);
    }
});
