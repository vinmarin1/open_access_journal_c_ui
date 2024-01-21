var currentTab = 0;
showTab(currentTab);

function showTab(n) {
    var x = document.getElementsByClassName("tab");
    var donateAmountInput = document.getElementsByName("donateamout")[0];

    // Log the value for debugging
    console.log("donateAmountInput value:", donateAmountInput.value);

    // Check if the hidden input has data
    if (donateAmountInput && donateAmountInput.value !== "") {
        currentTab = 1; 
    } else {
        currentTab = 0;
    }

    x[currentTab].style.display = "block";

    if (currentTab == (x.length - 1)) {
        document.getElementById("donateBtn").innerHTML = "<img src='../images/payLogo.png' alt='Logo' class='payLogo'>";
        document.getElementById("donateBtn").disabled = true;        
    } else {
        document.getElementById("donateBtn").innerHTML = "DONATE";
    }

    fixStepIndicator(currentTab);
}

function donate(n) {
    document.getElementById('donateForm').submit();

}

function validateForm() {

    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    
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

function handleCustomAmountSubmit() {
    var customAmountInput = document.getElementById('customAmount');
    var customAmount = parseFloat(customAmountInput.value);

    if (customAmount < 100) {
        alert('Please enter an amount equal to or greater than 100.');
    } else {
        document.getElementById('amount').value = customAmount;

        calculateAndDisplay(customAmount);

        togglePopup();
    }
}

function selectAmount(amount) {
    // Remove the "clicked" class from all buttons
    document.querySelectorAll('.amountBtn button').forEach(function (btn) {
        btn.classList.remove('clicked');
    });

    // Add the "clicked" class to the clicked button
    event.currentTarget.classList.add('clicked');

    // Calculate the equivalent heart points based on the selected amount
    calculateAndDisplay(amount);

    // Set the selected amount in the hidden input field
    document.getElementById('amount').value = amount;

}

function calculateAndDisplay(amount) {
    var heartPoints = amount / 50;

    document.getElementById('heartPoints').textContent = heartPoints;
    document.getElementById('amount').value = amount;
}