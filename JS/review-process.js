// let currentStep = 1;

// function nextStep() {
//     if (currentStep < 3) {
//         document.getElementById(`step${currentStep}`).classList.remove('active');
//         currentStep++;
//         document.getElementById(`step${currentStep}`).classList.add('active');
//     }

//     // if (currentStep === 2 && !document.getElementById('vehicle1').checked) {
//     //     alert('Please check the checkbox before proceeding.');
//     //     return;
//     // }
// }

// function prevStep() {
//     if (currentStep > 1) {
//         document.getElementById(`step${currentStep}`).classList.remove('active');
//         currentStep--;
//         document.getElementById(`step${currentStep}`).classList.add('active');
//     }
// }


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



// document.getElementById('acceptBtn').addEventListener('click', function(event){
//     const rejectBtn = document.getElementById('btnReject');
//     rejectBtn.style.display = 'none';
// });
let currentStep = 1;

document.getElementById('acceptBtn').addEventListener('click', function (event) {
    const rejectBtn = document.getElementById('btnReject');
    

    function nextStep() {
        if (currentStep < 3) {
            document.getElementById(`step${currentStep}`).classList.remove('active');
            currentStep++;
            document.getElementById(`step${currentStep}`).classList.add('active');
        }
    
    }

    Swal.fire({
        text: "Accept Invitation",
        icon: "info",
        showCancelButton: true,
        confirmButtonColor: "primary",
        cancelButtonColor: "secondary",
        confirmButtonText: "Accept"
    }).then((result) => {
        if (result.isConfirmed) {
            rejectBtn.style.display = 'none';
            Swal.fire({
                text: "Accepted Invitation",
                icon: "success",
                showConfirmButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    setTimeout(function () {
                        Swal.close();
                        nextStep();
                    }, 1000);
                }
            });
        }
    });
});




 



function prevStep() {
    if (currentStep > 1) {
        document.getElementById(`step${currentStep}`).classList.remove('active');
        currentStep--;
        document.getElementById(`step${currentStep}`).classList.add('active');
    }
}


document.getElementById('reviewBtn').addEventListener('click', function(event){
    function nextStep() {
        if (currentStep < 3) {
            document.getElementById(`step${currentStep}`).classList.remove('active');
            currentStep++;
            document.getElementById(`step${currentStep}`).classList.add('active');
        }
    
    }
    nextStep();
});

document.getElementById('btnReject').addEventListener('click', function(event){
    Swal.fire({
        title: "Decline Invitation",
        text: "You won't be able to revert this",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "secondary",
        confirmButtonText: "Decline"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                text: "Declined invitation",
                icon: "success",
                showConfirmButton: false,
            });

            setTimeout(function() {
                window.location.href = '../PHP/author-dashboard.php';
            }, 1000);
        }
    });
});

