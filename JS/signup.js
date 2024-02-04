const privacyPolicy = document.getElementById('privacyPolicy');
const modalBody = document.querySelector('.modal-body');

let hasScrolledToBottom = false;

function isScrolledToBottom() {
  return modalBody.scrollHeight - modalBody.scrollTop <= modalBody.clientHeight;
}


function handleScroll() {
  if (isScrolledToBottom() && !hasScrolledToBottom) {

    privacyPolicy.removeAttribute('disabled');
    hasScrolledToBottom = true;
  }
}


modalBody.addEventListener('scroll', handleScroll);


$('#exampleModal').on('shown.bs.modal', function () {
  handleScroll();
});

document.addEventListener('DOMContentLoaded', function() {
   
    var privacyPolicyCheckbox = document.getElementById('privacyPolicy');
    var agreeButton = document.getElementById('btn-agree');
    var closeButton = document.querySelector('.modal-content .btn-close');
 
    privacyPolicyCheckbox.addEventListener('change', function() {
    
        if (privacyPolicyCheckbox.checked) {
          
            agreeButton.removeAttribute('disabled');
        } else {
            
            agreeButton.setAttribute('disabled', 'disabled');
        }
    });

    agreeButton.addEventListener('click', function() {
        // Trigger a click on the close button
        closeButton.click();
    });

    
});




document.getElementById('form').addEventListener('submit', function(event) {
    event.preventDefault();

    const email = document.getElementById('email').value;
    const fname = document.getElementById('fname').value;
    const mdname = document.getElementById('mdname').value;
    const lname = document.getElementById('lname').value;
    const password = document.getElementById('password').value;

    const span1 = document.getElementById('span1');
    const span2 = document.getElementById('span2');
    const span3 = document.getElementById('span3');
    const span4 = document.getElementById('span4');
    const span5 = document.getElementById('span5');

    span1.style.display = 'none';
    span2.style.display = 'none';
    span3.style.display = 'none';
    span4.style.display = 'none';
    span5.style.display = 'none';

    let hasError = false;

    if (email === "") {
        span1.style.display = 'inline-block';
        hasError = true;
    }

    if (fname === "") {
        span2.style.display = 'inline-block';
        hasError = true;
    }

    if (mdname === "") {
        span3.style.display = 'inline-block';
        hasError = true;
    }

    if (lname === "") {
        span4.style.display = 'inline-block';
        hasError = true;
    }

    if (password === "") {
        span5.style.display = 'inline-block';
        hasError = true;
    }

    if (hasError) {
        return;
    }

    if (!privacyPolicy.checked) {
        Swal.fire({
            icon: "info",
            text: "You must read and agree with the terms and privacy of the website"
        });
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../PHP/signup-function.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                Swal.fire({
                    icon: "success",
                    text: response.message
                }).then(function() {
                    window.location.href = "../PHP/signup.php";
                });
            } else {
                Swal.fire({
                    icon: "error",
                    text: response.message
                });
            }
        }
    };
    xhr.send('email=' + encodeURIComponent(email) +
        '&fname=' + encodeURIComponent(fname) +
        '&mdname=' + encodeURIComponent(mdname) +
        '&lname=' + encodeURIComponent(lname) +
        '&password=' + encodeURIComponent(password) +
        '&privacyPolicy=' + encodeURIComponent(privacyPolicy));
});



document.getElementById('email').addEventListener('input', function() {
    document.getElementById('span1').style.display = 'none';
});

document.getElementById('fname').addEventListener('input', function() {
    document.getElementById('span2').style.display = 'none';
});

document.getElementById('mdname').addEventListener('input', function() {
    document.getElementById('span3').style.display = 'none';
});

document.getElementById('lname').addEventListener('input', function() {
    document.getElementById('span4').style.display = 'none';
});

document.getElementById('password').addEventListener('input', function() {
    document.getElementById('span5').style.display = 'none';
});






document.getElementById('email').addEventListener('blur', function() {
    const email = document.getElementById('email').value;
    if(email === ""){
        document.getElementById('span1').style.display = 'inline-block';
    }
   
});

document.getElementById('fname').addEventListener('blur', function() {
    const fname = document.getElementById('fname').value;
    if(fname === ""){
        document.getElementById('span2').style.display = 'inline-block';
    };
});

document.getElementById('mdname').addEventListener('blur', function() {
    const mdname = document.getElementById('mdname').value;
    if(mdname === ""){
        document.getElementById('span3').style.display = 'inline-block';
    };
});

document.getElementById('lname').addEventListener('blur', function() {
    const lname = document.getElementById('lname').value;
    if(lname === ""){
        document.getElementById('span4').style.display = 'inline-block';
    };
});

document.getElementById('password').addEventListener('blur', function() {
    const password = document.getElementById('password').value;
    if(password === ""){
        document.getElementById('span5').style.display = 'inline-block';
    };
});


