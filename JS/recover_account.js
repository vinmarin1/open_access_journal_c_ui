const emailInput = document.getElementById('email');
const sendBtn = document.getElementById('sendBtn');
const firstStep = document.getElementById('firstStep');
const secondStep = document.getElementById('secondStep');
const spinner = document.getElementById('spinner');
const firstStepLabel = document.getElementById('step1Label');
const secondStepLabel = document.getElementById('step2Label');
const getEmail = document.getElementById('getEmail');



emailInput.addEventListener('input', function () {
    const emailValue = emailInput.value.trim();
    const emailInputtedValue = document.getElementById('email').value;

    getEmail.innerText = emailInputtedValue;
   

    if (emailValue !== '' && isValidEmail(emailValue)) {
        sendBtn.removeAttribute('disabled');
    } else {
        sendBtn.setAttribute('disabled', 'disabled');
    }
});

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

sendBtn.addEventListener('click', function () {

    spinner.style.display = 'inline-block';
    sendBtn.setAttribute('disabled', 'disabled');

 
    setTimeout(function () {
        
        firstStep.style.display = 'none';
        firstStepLabel.style.display = 'none';
        secondStep.style.display = 'block';
        secondStepLabel.style.display = 'block';
        spinner.style.display = 'none';

        
    }, 3000); 
});



