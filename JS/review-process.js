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
            showLoader();
            setTimeout(function() {
                window.location.href = '../PHP/author-dashboard.php';
            }, 2000);


        }
    });
});


function showLoader() {
    const loadingOverlay = document.getElementById('loadingOverlay');
    loadingOverlay.style.display = 'block';
}

function toggleDiscussion(discussionId) {
    var discussionContainer = document.getElementById('discussion' + discussionId);
    if (discussionContainer.style.display === 'none') {
        discussionContainer.style.display = 'block';
    } else {
        discussionContainer.style.display = 'none';
    }
  }
  
  
function sendReply(discussionId, articleId) {
// Get the message from the corresponding textarea
var message = document.getElementById('reply-message-' + discussionId).value;
showLoader();
message.value = '';
setTimeout(function () {
    window.location.href = '../PHP/review-process.php?id=' + articleId;
}, 1000);
// Perform an AJAX request to send the reply
var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
    // Handle the response if needed
    console.log(xhr.responseText);
    }
};

xhr.open('POST', 'discussion-reply.php', true);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
xhr.send('discussion_id=' + discussionId + '&article_id=' + articleId + '&message=' + encodeURIComponent(message));
}



function rejectInvitation(articleId) {
var xhr = new XMLHttpRequest();

xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
        console.log(xhr.responseText);
        // Handle the response as needed
    }
};

xhr.open('POST', 'reject-invi.php', true);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
xhr.send('article_id=' + articleId);
}



function viewAllLogs() {
    var logEntries = document.getElementById('logEntries');
    var logDates = document.getElementById('logDates');
    var viewLogsBtn = document.getElementById('viewLogsBtn');
    var hideLogsBtn = document.getElementById('hideLogsBtn');

    var logEntriesChildren = logEntries.children;
    var logDatesChildren = logDates.children;

    for (var i = 0; i < logEntriesChildren.length; i++) {
        logEntriesChildren[i].style.display = 'block';
    }

    for (var j = 0; j < logDatesChildren.length; j++) {
        logDatesChildren[j].style.display = 'block';
    }

    viewLogsBtn.style.display = 'none';
    hideLogsBtn.style.display = 'block';
}

function hideLogs() {
    var logEntries = document.getElementById('logEntries');
    var logDates = document.getElementById('logDates');
    var viewLogsBtn = document.getElementById('viewLogsBtn');
    var hideLogsBtn = document.getElementById('hideLogsBtn');

    var logEntriesChildren = logEntries.children;
    var logDatesChildren = logDates.children;

    for (var i = 0; i < logEntriesChildren.length; i++) {
        if (i < 5) {
            logEntriesChildren[i].style.display = 'block';
        } else {
            logEntriesChildren[i].style.display = 'none';
        }
    }

    for (var j = 0; j < logDatesChildren.length; j++) {
        if (j < 5) {
            logDatesChildren[j].style.display = 'block';
        } else {
            logDatesChildren[j].style.display = 'none';
        }
    }

    viewLogsBtn.style.display = 'block';
    hideLogsBtn.style.display = 'none';
}

 