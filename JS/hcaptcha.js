let captchaSolved = false;

// Function to render the hCaptcha widget and handle callback
function render() {
    hcaptcha.render(document.querySelector(".h-captcha"), {
        sitekey: "540dedd9-f0b7-412d-a713-1c4e383ee944",
        callback: (token) => {
            captchaSolved = true;
            checkCaptchaStatus(); 
            console.log(captchaSolved,"ff");
        },
        size: "normal"
    });
}

// Function to check the captcha status
function checkCaptchaStatus() {
    if (captchaSolved) {
        console.log("Captcha solved!");
    } else {
        console.log("Captcha not solved yet.");
    }
}

render();