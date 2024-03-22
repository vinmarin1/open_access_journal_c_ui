var titleElement = document.getElementById('title');
var titleInputElement = document.getElementById('titleInput');


titleInputElement.value = titleElement.innerText;

titleElement.addEventListener('input', function() {
    titleInputElement.value = titleElement.innerText;
});


var abstractElement = document.getElementById('display-abstract');
var abstractInput = document.getElementById('abstract');


abstractInput.value = abstractElement.innerText;

abstractElement.addEventListener('input', function() {
    abstractInput.value = abstractElement.innerText;
});

function openFilename(index) {
  var input = document.getElementById('file_name' + (index === 1 ? '' : index));
  input.click();

  input.addEventListener('change', function() {
      var fileName = input.files[0].name;
      var fileSize = input.files[0].size; // Size in bytes

      // Check if the file size is greater than 1.5 MB
      if (fileSize > 1.5 * 1024 * 1024) { // Convert MB to bytes
          Swal.fire({
            icon: 'warning',
            text: 'Please select a file 1.5 mb or less'
          });
          input.value = ''; // Clear the selected file
          document.getElementById('fileName' + index).innerText = ''; // Clear the displayed file name
          return;
      }

      document.getElementById('fileName' + index).innerText = fileName;
  });
}
  function deleteFilename(index) {
    // Get the file input associated with the row
    var fileInput = document.getElementById('file_name' + (index === 1 ? '' : index));
  
    // Clear the value of the file input
    fileInput.value = '';
  
    // Optionally, you can clear the displayed file name in the table
    document.getElementById('fileName' + index).innerText = '';
    // document.getElementById('fileType' + index).innerText = '';
  }


  

  document.getElementById('edit-submission').addEventListener('click', function (event) {
    // Show loader
    showLoader();

    // Delay execution of style changes
    setTimeout(function () {
        const reviseFile = document.getElementById('reviseFile');
        const cancelbtn = document.getElementById('cancel-submission');
        const editBtn = document.getElementById('edit-submission');
        const submitBtn = document.getElementById('submit-submission');
        const titleElement = document.getElementById('title');
        const abstract = document.getElementById('display-abstract');
       

        titleElement.contentEditable = true;
        titleElement.style.border = '1px black solid';
        abstract.contentEditable = true;
        abstract.style.border = '1px black solid';
        reviseFile.style.display = 'block';
        cancelbtn.style.display = 'block';
        submitBtn.style.display = 'block';
        editBtn.style.display = 'none';
       

        // Hide loader after execution
        hideLoader();
    }, 3000); // 3000 milliseconds (3 seconds) delay
});

document.getElementById('cancel-submission').addEventListener('click', function (event) {
    // Show loader
    showLoader();

    // Delay execution of style changes
    setTimeout(function () {
        const reviseFile = document.getElementById('reviseFile');
        const cancelbtn = document.getElementById('cancel-submission');
        const editBtn = document.getElementById('edit-submission');
        const submitBtn = document.getElementById('submit-submission');
        const titleElement = document.getElementById('title');
        const abstract = document.getElementById('display-abstract');

        titleElement.contentEditable = false;
        titleElement.style.border = 'none';
        abstract.contentEditable = false;
        abstract.style.border = 'none';
        table.style.display = 'none';
        reviseFile.style.display = 'none';
        cancelbtn.style.display = 'none';
        submitBtn.style.display = 'none';
        editBtn.style.display = 'block';

        // Hide loader after execution
        hideLoader();
    }, 3000); // 3000 milliseconds (3 seconds) delay
});

// Function to show loader
function showLoader() {
    const loadingOverlay = document.getElementById('loadingOverlay');
    loadingOverlay.style.display = 'block';
}

// Function to hide loader
function hideLoader() {
    const loadingOverlay = document.getElementById('loadingOverlay');
    loadingOverlay.style.display = 'none';
}






// document.addEventListener('DOMContentLoaded', function () {
//   const titleValidation = document.getElementById('title-validation');
//   const titleParagraph = document.getElementById('title');
//   const abstractValidation = document.getElementById('abstract-validation');
//   const abstractParagraph = document.getElementById('display-abstract');
//   const submitButton = document.getElementById('submit-submission');
//   const form = document.getElementById('form');

//   function validateTitle() {
//     const wordsTitle = titleParagraph.innerText.split(/\s+/);
//     const wordCountTitle = wordsTitle.length;

//     if (wordCountTitle < 5 || wordCountTitle > 100) {
//       titleValidation.style.display = 'inline-block';
//       return false;
//     } else {
//       titleValidation.style.display = 'none';
//       return true;
//     }
//   }

//   function validateAbstract() {
//     const wordsAbstract = abstractParagraph.innerText.split(/\s+/);
//     const wordCountAbstract = wordsAbstract.length;

//     if (wordCountAbstract <10 || wordCountAbstract > 250) {
//       abstractValidation.style.display = 'inline-block';
//       return false;
//     } else {
//       abstractValidation.style.display = 'none';
//       return true;

//     }
//   }

//   function updateSubmitButtonState() {
//     const isTitleValid = validateTitle();
//     const isAbstractValid = validateAbstract();

//     submitButton.disabled = !(isTitleValid && isAbstractValid);
//   }

//   // Add event listeners
//   titleParagraph.addEventListener('input', updateSubmitButtonState);
//   abstractParagraph.addEventListener('input', updateSubmitButtonState);
// });


document.getElementById('submit-submission').addEventListener('click', function(event){
  const form = document.getElementById('form');
  const file = document.getElementById('file_name');
  const titleInput = document.getElementById('titleInput');
  const abstract = document.getElementById('abstract');
  const titleValidationSpan = document.getElementById('title-validation');
  const abstractValidationSpan = document.getElementById('abstract-validation');
  const fileTypeSelect = document.getElementById('selectRevisionFileType');

  if (file.value === '') {
    Swal.fire({
      icon: 'warning',
      text: 'File is required!'
    });
  } else {
    const titleWords = titleInput.value.split(/\s+/).filter(word => word.length > 0).length;
    const abstractWords = abstract.value.split(/\s+/).filter(word => word.length > 0).length;

    if (titleWords < 5 || titleWords > 100) {
      titleValidationSpan.style.display = 'block';
    } else {
      titleValidationSpan.style.display = 'none';
    }

    if (abstractWords < 10 || abstractWords > 300) {
      abstractValidationSpan.style.display = 'block';
    } else {
      abstractValidationSpan.style.display = 'none';
    }

    if (titleWords < 5 || titleWords > 100 || abstractWords < 10 || abstractWords > 300) {
      Swal.fire({
        icon: 'warning',
        text: 'Please correct your Title or Abstract based on requirements'
      });
    } else if (fileTypeSelect.value === '') {
      Swal.fire({
        icon: 'warning',
        text: 'Please select a file type'
      });
    } else {
      Swal.fire({
        icon: 'question',
        text: 'Submit Revision?',
        showCancelButton: true,
        confirmButtonText: 'Yes',
      }).then((result) => {
        if (result.isConfirmed) {
          showLoader();
          form.submit();
        }
      });
      
    }
  }
});


// function submitData() {
//   // Get data from <p> elements
//   var title = document.getElementById('title').innerText;
//   var abstract = document.getElementById('display-abstract').innerText;
//   var articleId = document.getElementById('getArticleId').value; // Assuming you have an input field for articleId
//   showLoader();
//   setTimeout(function () {
//     window.location.href = '../PHP/submitted-article.php?id=' + articleId;
//   }, 1000);
//   // Use AJAX to send data to the server
//   var xhr = new XMLHttpRequest();
//   xhr.open('POST', 'revise.php', true);
//   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//   xhr.onreadystatechange = function () {
//       if (xhr.readyState === 4 && xhr.status === 200) {
          
//           console.log(xhr.responseText);

//          // Redirect after the AJAX request is complete
//          window.location.href = '../PHP/submitted-article.php?id=' + articleId;
//       }
//   };

//   var data = 'title=' + encodeURIComponent(title) + '&abstract=' + encodeURIComponent(abstract) + '&getArticleId=' + encodeURIComponent(articleId);
//   xhr.send(data);
 
  
// }


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
    window.location.href = '../PHP/submitted-article.php?id=' + articleId;
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