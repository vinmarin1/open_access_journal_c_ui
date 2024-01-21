var currentTab = 0; 
showTab(currentTab); 

function showTab(n) {

var x = document.getElementsByClassName("tab");
x[n].style.display = "block";

    if (n == (x.length - 1)) {
    document.getElementById("donateBtn").innerHTML = "<img src='../images/payLogo.png' alt='Logo' class='payLogo'>";
    } else {
    document.getElementById("donateBtn").innerHTML = "DONATE";
    }
    fixStepIndicator(n)
}

function donate(n) {

    var x = document.getElementsByClassName("tab");

    if (n == 1 && !validateForm()) return false;

    x[currentTab].style.display = "none";

    currentTab = currentTab + n;

    if (currentTab >= x.length) {

    document.getElementById("donateForm").submit();
    return false;
    }

    showTab(currentTab);
}

function validateForm() {

    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("");
    
    for (i = 0; i < y.length; i++) {
        if (y[i].value == "") {

        y[i].className += " invalid";
        valid = false;
    }
    }
    if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; 
}

function fixStepIndicator(n) {
    var i, x = document.getElementsByClassName("step");

    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }

    // Add "active" class to the current step indicator
    x[n].className += " active";
}


function selectAmount(amount) {
    // Remove the "clicked" class from all buttons
    document.querySelectorAll('.amountBtn button').forEach(function(btn) {
        btn.classList.remove('clicked');
    });

    // Add the "clicked" class to the clicked button
    event.currentTarget.classList.add('clicked');

    // Calculate the equivalent heart points based on the selected amount
    var heartPoints = amount / 50;

    // Update the "Earn" span
    document.getElementById('heartPoints').textContent = heartPoints;
}

function togglePopup() {
    var popup = document.getElementById('customAmountPopup');
    var overlay = document.getElementById('overlay');
    if (popup.style.display === 'none' || popup.style.display === '') {
        popup.style.display = 'block';
        overlay.style.display = 'block';
    } else {
        popup.style.display = 'none';
        overlay.style.display = 'none';
    }
}

// Function to handle custom amount submission
function handleCustomAmountSubmit() {
    var customAmountInput = document.getElementById('customAmount');
    var customAmount = parseFloat(customAmountInput.value);

    if (customAmount < 100) {
        alert('Please enter an amount equal to or greater than 100.');
    } else {
        alert('Custom Amount Submitted: ' + customAmount);
        togglePopup(); // Close the popup after submission
    }
}

