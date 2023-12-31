let currentStep = 1;

function nextStep() {
    if (currentStep < 3) {
        document.getElementById(`step${currentStep}`).classList.remove('active');
        currentStep++;
        document.getElementById(`step${currentStep}`).classList.add('active');
    }

    // if (currentStep === 2 && !document.getElementById('vehicle1').checked) {
    //     alert('Please check the checkbox before proceeding.');
    //     return;
    // }
}

function prevStep() {
    if (currentStep > 1) {
        document.getElementById(`step${currentStep}`).classList.remove('active');
        currentStep--;
        document.getElementById(`step${currentStep}`).classList.add('active');
    }
}


document.addEventListener('DOMContentLoaded', function(event) {
    const checkboxGuidelines = document.getElementById('checkBox');
    const reviewBtn = document.getElementById('reviewBtn');

    checkboxGuidelines.addEventListener('change', function(event){
        if(checkboxGuidelines.checked){
            reviewBtn.disabled = false;
        }else{
            reviewBtn.disabled = true;
        }
    });
});

document.getElementById('form').addEventListener('submit', function(event) {
   
  
    const loadingOverlay = document.getElementById('loadingOverlay');
    const inputs = this.querySelectorAll('input');


    let isEmpty = false;

    inputs.forEach(input => {
        if (input.value.trim() === '') {
            isEmpty = true;
        }
    });

  
    if (!isEmpty) {
        this.submit();
        loadingOverlay.style.display = "block";
    } else {
       
        event.preventDefault();
    }
});




