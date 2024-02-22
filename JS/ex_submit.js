document.addEventListener('keydown', function(event) {
  if (event.key === 'Enter') {
      event.preventDefault();
  }
});



// document.addEventListener('DOMContentLoaded', function () {
//   var tabButtons = document.querySelectorAll('.nav-link');
//   var tabContent = document.querySelectorAll('.tab-pane input');
//   var selectedTabIndex = 0;
//   var prevBtn = document.getElementById("prev");
//   var nextBtn = document.getElementById("next");
//   var submitBtn = document.getElementById("submit");
//   var form = document.getElementById("form");
//   var inputFields = form.querySelectorAll("input");


//   for (var i = 1; i < tabButtons.length; i++) {
//     tabButtons[i].disabled = true;
//   }



//   function updateButtonVisibility(index) {
//     // Display buttons based on the current tab index
//     if (index === 0) {
//       prevBtn.style.display = "none";
//       nextBtn.style.display = "inline-block";
//       submitBtn.style.display = "none";
  
//     }else if(index === 1){
//       prevBtn.style.display = "inline-block";
//       nextBtn.disabled = true;
//       submitBtn.style.display = "none";

 
//     } 
//     else if (index > 0 && index < tabButtons.length - 1) {
//       prevBtn.style.display = "inline-block";
//       nextBtn.style.display = "inline-block";
//       submitBtn.style.display = "none";
  
//     } else if (index === tabButtons.length - 1) {
//       prevBtn.style.display = "inline-block";
//       nextBtn.style.display = "none";
//       submitBtn.style.display = "inline-block";
  
//     }
//   }

//   function updateStyles() {
//     tabButtons.forEach(function (btn, i) {
//       if (i === selectedTabIndex) {
//         btn.style.backgroundColor = "#0858a4";
//         btn.style.color = "white";
//         btn.style.border = "none";
//       } else {
//         btn.style.backgroundColor = "white";
//         btn.style.border = "none";
//         btn.style.color = "#0858a4";
//       }
//     });
//   }

//   function updateButtonStates(index) {
//     for (var i = index + 1; i < tabButtons.length; i++) {
//       tabButtons[i].disabled = tabContent[i - 1].value === '';
//     }
//   }

//   function switchToNextTab() {
//     if (selectedTabIndex < tabButtons.length - 1) {
//       inputFields = tabContent[selectedTabIndex];
//       if (inputFields.value === '' || tabButtons[selectedTabIndex + 1].disabled) {
     
//         Swal.fire({
//           html: '<h4 style="color: #0858a4; font-family: font-family: Arial, Helvetica, sans-serif">Please read and check the guidelines to proceed</4>',
//           icon: 'warning',
//         })
//       }

//       tabButtons[selectedTabIndex + 1].click(); // Simulate a click on the next tab button
      
//     }
//   }

//   function switchToPrevTab() {
//     if (selectedTabIndex > 0) {
//       tabButtons[selectedTabIndex - 1].click(); // Simulate a click on the previous tab button
//       nextBtn.disabled = false;
//     }
//   }

//   tabContent.forEach(function (input, index) {
//     input.addEventListener('input', function () {
//       updateButtonStates(index);
//       updateStyles();
//     });

//     input.addEventListener('focus', function () {
//       updateStyles();
//     });

//     input.addEventListener('blur', function () {
//       // Don't change styles on blur
//     });
//   });

//   tabButtons.forEach(function (button, index) {
//     button.addEventListener('click', function () {
//       selectedTabIndex = index;
//       updateButtonVisibility(index);
//       updateButtonStates(index);
//       updateStyles();
//     });

//     // Set initial styles and button visibility for the first button
//     if (index === 0) {
//       button.style.backgroundColor = "#0858a4";
//       button.style.color = "white";
//       updateButtonVisibility(index);
//     }

  
    
//   });




//   nextBtn.addEventListener('click', switchToNextTab);
//   prevBtn.addEventListener('click', switchToPrevTab);

  

  
  
// });

document.addEventListener('DOMContentLoaded', function(){

  const nextBtnArticle = document.getElementById('next');
  const nextBGuide = document.getElementById('next1');
  const prevBtnArticle = document.getElementById('prev');
  const nextFile = document.getElementById('next3');
  const prevBFile = document.getElementById('prev3');
  const nextCont = document.getElementById('next4');
  const prevBCont = document.getElementById('prev4');
  const authorPcontact = document.getElementById('authorPcontact');
  const nextNote = document.getElementById('next5');
  const prevNote = document.getElementById('prev5');
  const prevReview = document.getElementById('prevReview');
  const submitBtn = document.getElementById('submit');
  const privacyTab = document.getElementById('privacy-tab');
  const articleTab = document.getElementById('article-tab');
  const fileTab = document.getElementById('file-tab');
  const contTab = document.getElementById('contributors-tab');
  const commentTab = document.getElementById('comment-tab');
  const reviewTab = document.getElementById('review-tab');
  const file_name = document.getElementById('file_name');
  const file_name2 = document.getElementById('file_name2');
  const file_name3 = document.getElementById('file_name3');

  const checkbox1 = document.getElementById('check-1');
  const checkbox2 = document.getElementById('check-2');
  const checkbox3 = document.getElementById('check-3');
  const checkbox4 = document.getElementById('check-4');
  const checkbox5 = document.getElementById('check-6');
  const checkbox6 = document.getElementById('check-7');
  const check = document.getElementById('check');
  
  

  const title = document.getElementById('title');
  const abstract = document.getElementById('abstract');
  const keywords = document.getElementById('keywords');
  const reference = document.getElementById('reference');


  articleTab.disabled = true;
  fileTab.disabled = true;
  contTab.disabled = true;
  commentTab.disabled = true;
  reviewTab.disabled = true;



 
  
  privacyTab.style.backgroundColor ='#0858a4';
  privacyTab.style.color ='white';

  privacyTab.addEventListener('click', function(event){
    privacyTab.style.backgroundColor = '#0858a4';
    privacyTab.style.color = 'white';

    articleTab.style.backgroundColor = 'white';
    articleTab.style.color = '#0858a4';
    fileTab.style.backgroundColor = 'white';
    fileTab.style.color = '#0858a4';
    contTab.style.backgroundColor = 'white';
    contTab.style.color = '#0858a4';
    commentTab.style.backgroundColor = 'white';
    commentTab.style.color = '#0858a4';
    reviewTab.style.backgroundColor = 'white';
    reviewTab.style.color = '#0858a4';

  });

  articleTab.addEventListener('click', function(event){
    privacyTab.style.backgroundColor = 'white';
    privacyTab.style.color = '#0858a4';
    articleTab.style.backgroundColor = '#0858a4';
    articleTab.style.color = 'white';
    fileTab.style.backgroundColor = 'white';
    fileTab.style.color = '#0858a4';
    contTab.style.backgroundColor = 'white';
    contTab.style.color = '#0858a4';
    commentTab.style.backgroundColor = 'white';
    commentTab.style.color = '#0858a4';
    reviewTab.style.backgroundColor = 'white';
    reviewTab.style.color = '#0858a4';

  });

  fileTab.addEventListener('click', function(event){
    privacyTab.style.backgroundColor = 'white';
    privacyTab.style.color = '#0858a4';
    articleTab.style.backgroundColor = 'white';
    articleTab.style.color = '#0858a4';
    fileTab.style.backgroundColor = '#0858a4';
    fileTab.style.color = 'white';
    contTab.style.backgroundColor = 'white';
    contTab.style.color = '#0858a4';
    commentTab.style.backgroundColor = 'white';
    commentTab.style.color = '#0858a4';
    reviewTab.style.backgroundColor = 'white';
    reviewTab.style.color = '#0858a4';

  });

  contTab.addEventListener('click', function(event){
    privacyTab.style.backgroundColor = 'white';
    privacyTab.style.color = '#0858a4';
    articleTab.style.backgroundColor = 'white';
    articleTab.style.color = '#0858a4';
    fileTab.style.backgroundColor = 'white';
    fileTab.style.color = '#0858a4';
    contTab.style.backgroundColor = '#0858a4';
    contTab.style.color = 'white';
    commentTab.style.backgroundColor = 'white';
    commentTab.style.color = '#0858a4';
    reviewTab.style.backgroundColor = 'white';
    reviewTab.style.color = '#0858a4';

  });

  commentTab.addEventListener('click', function(event){
    privacyTab.style.backgroundColor = 'white';
    privacyTab.style.color = '#0858a4';
    articleTab.style.backgroundColor = 'white';
    articleTab.style.color = '#0858a4';
    fileTab.style.backgroundColor = 'white';
    fileTab.style.color = '#0858a4';
    contTab.style.backgroundColor = 'white';
    contTab.style.color = '#0858a4';
    commentTab.style.backgroundColor = '#0858a4';
    commentTab.style.color = 'white';
    reviewTab.style.backgroundColor = 'white';
    reviewTab.style.color = '#0858a4';

  });


  reviewTab.addEventListener('click', function(event){
    privacyTab.style.backgroundColor = 'white';
    privacyTab.style.color = '#0858a4';
    articleTab.style.backgroundColor = 'white';
    articleTab.style.color = '#0858a4';
    fileTab.style.backgroundColor = 'white';
    fileTab.style.color = '#0858a4';
    contTab.style.backgroundColor = 'white';
    contTab.style.color = '#0858a4';
    commentTab.style.backgroundColor = 'white';
    commentTab.style.color = '#0858a4';
    reviewTab.style.backgroundColor = '#0858a4';
    reviewTab.style.color = 'white';

  });

  authorPcontact.addEventListener('change', function(event){
    if (authorPcontact.checked){
      authorPcontact.value = 'Primary Contact';
    }else{
      authorPcontact.value = '';
    }
  });

  nextBtnArticle.addEventListener('click', function(event) {
    const titleValue = title.value.trim(); 
    const titleWordCount = titleValue.split(/\s+/).length; 
    const abstractValue = abstract.value.trim(); 
    const abstractWordCount = abstractValue.split(/\s+/).length; 
    const keywordsValue = keywords.value.trim(); 
    const checkArticle = document.getElementById('check-duplication');


    // if(!checkArticle.clicked){
      
    // }

    if (titleValue === '' || abstract.value === '' || keywordsValue === '' || reference.value === ''){
      
        Swal.fire({
            icon: 'warning',
            text: 'You have to give all the article details before proceeding'
        });
    } else if (titleWordCount < 5 || abstractWordCount < 10 || !keywordsValue.includes(',') || keywordsValue === ',') {
        Swal.fire({
            icon: 'warning',
            text: 'Kindly correct the article details by the said validation'
        });
    } else {
        fileTab.disabled = false;
        fileTab.click();
    }
});



  nextFile.addEventListener('click', function(event){
    if (file_name.value === '' || file_name2.value === '' || file_name3.value === ''){
      Swal.fire({
        icon: 'warning',
        text: 'You have to provide the files requested'
       });
    }else{
      contTab.disabled = false;
      contTab.click();
    }
  });

  nextCont.addEventListener('click', function(event){
    commentTab.disabled = false;
    commentTab.click();
  });

  nextNote.addEventListener('click', function(event){
    reviewTab.disabled = false;
    reviewTab.click();
  });



  prevBtnArticle.addEventListener('click', function(event){
    privacyTab.click();
  });

  prevBFile.addEventListener('click', function(event){
    articleTab.click();
  });


  prevBCont.addEventListener('click', function(event){
    fileTab.click();
  });
  
  prevBCont.addEventListener('click', function(event){
    fileTab.click();
  });
  
  prevNote.addEventListener('click', function(event){
    contTab.click();
  });
  
  prevReview.addEventListener('click', function(event){
    commentTab.click();
  });
  

  const checkboxes = document.querySelectorAll('.my-checkbox');
  const saveBtn = document.getElementById('submit');
  


  checkboxes.forEach(function(checkbox) {
      checkbox.addEventListener('change', function() {
          const anyUnchecked = Array.from(checkboxes).some(function(cb) {
              return !cb.checked;
          });

          saveBtn.disabled = anyUnchecked;
      });
  });





  nextBGuide.addEventListener('click', function() {
      const allChecked = Array.from(checkboxes).every(function(cb) {
          return cb.checked;
      });

      

      if (!allChecked) {
        
     
         Swal.fire({
          icon: 'warning',
          text: 'You have to accept the website submission guidlines'
         });
      } else {
          
          articleTab.disabled = false;
          articleTab.click();
        
        
      }
  });


 

});



document.getElementById('title').addEventListener('input' , function(event){
  const title = document.getElementById('title').value;
  const titlePreview = document.getElementById('input5f1');
  

  

  titlePreview.value = title;

});


document.getElementById('editor').addEventListener('input' , function(event){
  const editor = document.getElementById('editor').value;
  const abstractPreview = document.getElementById('input7');
  const abstract = document.getElementById('abstract');
  
  abstractPreview.value = editor;
  abstract.value = editor;
});


document.getElementById('keywords').addEventListener('input' , function(event){
  const keywords = document.getElementById('keywords').value;
  const keywordsPreview = document.getElementById('input6');


  keywordsPreview.value = keywords;


});

document.getElementById('editor2').addEventListener('input' , function(event){
  const editor2 = document.getElementById('editor2').value;
  const referencePreview = document.getElementById('input8');
  const reference = document.getElementById('reference');
  

  referencePreview.value = editor2;
  reference.value = editor2;

});


document.getElementById('editor3').addEventListener('input' , function(event){
  const editor3 = document.getElementById('editor3').value;
  const notes = document.getElementById('notes');
 
  

  notes.value = editor3;


});




document.addEventListener('DOMContentLoaded', function () {
  const titleInput = document.getElementById('title');
  const editor = document.getElementById('editor');
  const keywords = document.getElementById('keywords');
  const editor2 = document.getElementById('editor2');

  const titleValidation = document.getElementById('title-validation');
  const abstractValidation = document.getElementById('abstract-validation');
  const keywordsValidation = document.getElementById('keywords-validation');
  const referenceValidation = document.getElementById('reference-validation');

  const formFloating = document.getElementById('form-floating');
  const formFloating2 = document.getElementById('form-floating-2');
  const formFloating3 = document.getElementById('form-floating-3')

  function checkValidations() {
      // Check if all validations have passed and all inputs have a value
      if (
          titleValidation.style.display === 'none' &&
          abstractValidation.style.display === 'none' &&
          keywordsValidation.style.display === 'none' &&
          referenceValidation.style.display === 'none' &&
          titleInput.value.trim() !== '' &&
          editor.value.trim() !== '' &&
          keywords.value.trim() !== '' &&
          editor2.value.trim() !== ''
      ) {
          formFloating.style.width = '60%';
          formFloating2.style.display = 'inline-block';
          formFloating3.style.width = '60%';
      } else {
          formFloating.style.width = '100%';
          formFloating2.style.display = 'none';
          formFloating3.style.width = '100%';
      }
  }

  titleInput.addEventListener('blur', function () {
      const wordCount = titleInput.value.trim().split(/\s+/).length;

      if (wordCount < 4) {
          titleValidation.innerHTML = "Title is too short. Please provide a comprehensive title."
          titleValidation.style.display = 'block';
      } else if(wordCount >100){
          titleValidation.innerHTML = "Title is too long."
          titleValidation.style.display = 'block';
      } else {
          titleValidation.style.display = 'none';
      }

      checkValidations();
  });

  editor.addEventListener('blur', function () {
    const text = editor.value.trim();
    const wordCount = text === "" ? 0 : text.match(/\b(?![\(\)\[\]\{\}]+)\S+\b/g).length;
    if (wordCount < 100) {
      abstractValidation.innerHTML = "Abstract too short";
      abstractValidation.style.display = "block";
    } else if (wordCount > 300) {
      abstractValidation.innerHTML = "Please limit your abstract to a maximum of 300 words";
      abstractValidation.style.display = "block";
    } else {
      abstractValidation.style.display = "none";
    }
    checkValidations();
  });
  
  editor.addEventListener('input', function () {
    const text = editor.value.trim();
    const wordCount = text === "" ? 0 : text.match(/\b(?![\(\)\[\]\{\}]+)\S+\b/g).length;
    document.querySelector("#total-words-abstract").innerHTML = `${wordCount} / 300 words`;
  });

  keywords.addEventListener('blur', function () {
      const wordCount = keywords.value.trim().split(",").length;

      if (wordCount <= 4) {
          keywordsValidation.style.display = 'block';
      } else {
          keywordsValidation.style.display = 'none';
      }

      checkValidations();
  });

  editor2.addEventListener('input', function () {
      const referenceText = editor2.value.trim();

      if (referenceText === '') {
          referenceValidation.style.display = 'block';
      } else {
          referenceValidation.style.display = 'none';
      }

      checkValidations();
  });
});



function openFilename(index) {
  var input = document.getElementById('file_name' + (index === 1 ? '' : index));
  input.click();

  input.addEventListener('change', function () {
      checkFileSize(input, 1.5 * 1024 * 1024, index);
  });
}

function checkFileSize(input, maxSizeInBytes, index) {
  var files = input.files;

  if (files.length > 0) {
      var fileSize = files[0].size; // in bytes
      var maxSize = maxSizeInBytes;

      if (fileSize > maxSize) {
          Swal.fire({
              icon: 'warning',
              text: 'Please select a file equal or less than 1.5 MB to continue'
          });
          var fileInput = document.getElementById('file_name' + (index === 1 ? '' : index));

          // Clear the value of the file input
          fileInput.value = '';
      } else {
          var fileName = input.files[0].name;
          document.getElementById('fileName' + index).innerText = fileName;
      }
  }
}

document.getElementById('file_name').addEventListener('change', function () {
  openFilename(1);
});

document.getElementById('file_name2').addEventListener('change', function () {
  openFilename(2);
});

document.getElementById('file_name3').addEventListener('change', function () {
  openFilename(3);
});


function deleteFilename(index) {

  var fileInput = document.getElementById('file_name' + (index === 1 ? '' : index));

  // Clear the value of the file input
  fileInput.value = '';

  // Optionally, you can clear the displayed file name in the table
  document.getElementById('fileName' + index).innerText = '';
  // document.getElementById('fileType' + index).innerText = '';
}


function setupFileInput(fileInputId, textInputId) {
  document.getElementById(fileInputId).addEventListener('change', function(event) {
    const fileInput = event.target;
    const fileName = fileInput.files[0].name;

    // Update the value of the corresponding text input with the selected file name
    document.getElementById(textInputId).value = fileName;
  });
}

// Set up listeners for each file input and corresponding text input
setupFileInput('file_name', 'input9');
setupFileInput('file_name2', 'input9f');
setupFileInput('file_name3', 'input9g');
setupFileInput('file_name', 'file1UpdatePreview');
setupFileInput('file_name2', 'file2UpdatePreview');
setupFileInput('file_name3', 'file3UpdatePreview');








document.getElementById('update-cont-2').addEventListener('click', function(event) {

  const input5f1 = document.getElementById('input5f1').value;
  const input7 = document.getElementById('input7').value;
  const input6 = document.getElementById('input6').value;
  const input8 = document.getElementById('input8').value;
 
  

  Swal.fire({
    html: '<div id="update-article-info-container">' +
    '<p class="h5" id="update-article-title" style=" font-family: Arial, Helvetica, sans-serif;">Update Article Details</p><br><hr>' +
    '<div id="preview-details-inputs">' +
    '<p class="h6 mt-5" id="previewTitlelabel">Title:</p> ' + 
    '<input type="text" class="form-control" id="titleInputPreview" value=" '+ input5f1 +' ">' +
    '<p class="h6" id="previewAbstractlabel">Abstract:</p> ' + 
    '<textarea class="form-control" name="abstractInputPreview" id="abstractInputPreview" cols="30" rows="5" style="width: 95%; height: auto" >'+ input7 +'</textarea>' +
    '<p class="h6" id="previewKeywordlabel">Keyword:</p> ' + 
    '<input type="text" class="form-control" id="keywordInputPreview" value=" '+ input6 +' ">' +
    
    '<p class="h6" id="referenceAbstractlabel">Reference:</p> ' + 
    '<textarea class="form-control" name="abstractInputPreview" id="referencetInputPreview" cols="30" rows="5" style="width: 95%; height: auto" >'+ input8 +'</textarea>' +
    '</div>'+
    '</div>' + '<button class="btn btn-primary btn-sm" id="btnPreview_Update">Update</button>',
    showConfirmButton: false,
  });

  document.getElementById('btnPreview_Update').addEventListener('click', function(event){
    const titleInputPreview = document.getElementById('titleInputPreview').value;
    const abstractInputPreview = document.getElementById('abstractInputPreview').value;
    const keywordInputPreview = document.getElementById('keywordInputPreview').value;
    const referencetInputPreview = document.getElementById('referencetInputPreview').value;

    const title = document.getElementById('title').value = titleInputPreview;
    const editor = document.getElementById('editor').value = abstractInputPreview;
    const keywords = document.getElementById('keywords').value = keywordInputPreview;
    const editor2 = document.getElementById('editor2').value = referencetInputPreview;

    const input5f1 = document.getElementById('input5f1').value = titleInputPreview;
    const input7 = document.getElementById('input7').value = abstractInputPreview;
    const input6 = document.getElementById('input6').value = keywordInputPreview;
    const input8 = document.getElementById('input8').value = referencetInputPreview;


    Swal.close();
  });

});

document.getElementById('update-cont-3').addEventListener('click', function(event){

  const input9 = document.getElementById('input9').value;
  const input9f = document.getElementById('input9f').value;
  const input9g = document.getElementById('input9g').value;

  Swal.fire({
    html: '<div id="updatePreviewFileContainer">' + 
          '<p class="h5" id="updatePreviewFileTitle">Update Files</p><br><hr> ' +
          '<p class="h6 mt-5" id="updatePreviewFile1">File with author name: </p>' +
          '<input type="text" class="form-control" id="file1UpdatePreview"  value="' + input9 +'" disabled>' + '<button type="button" class="btn btn-primary btn-sm" id="btnSelectFile1" onclick="openFilename(1)">Select File</button>' + 
          '<p class="h6" id="updatePreviewFile2">File With no author name: </p>' +
          '<input type="text" class="form-control" id="file2UpdatePreview" value="' + input9f +'" disabled>' +
          '<button type="button" class="btn btn-primary btn-sm" id="btnSelectFile2" onclick="openFilename(2)">Select File</button>' +
          '<p class="h6" id="updatePreviewFile3">Title Page: </p>' +
          '<input type="text" class="form-control" id="file3UpdatePreview" value="' + input9g +'" disabled>' +
          '<button type="button" class="btn btn-primary btn-sm" id="btnSelectFile2" onclick="openFilename(3)">Select File</button><br>' +
          '<button type="button"  class="btn btn-secondary btn-sm mt-4" id="btnClose" >Close</button> ' +
          '</div>',
    showConfirmButton: false,
  });

  document.getElementById('btnClose').addEventListener('click', function(event) {

    

    Swal.close();

  });



});



function addRow() {
  var index = $('#contributorTable tbody tr').length; // Get the current row index
  var newRow = '<tr>' +
      '<td><input class="form-control email-input" type="email" name="emailC[]" style="height: 30px;" ></td>' +
      '<td><input class="form-control" type="text" name="firstnameC[]" style="height: 30px;" ></td>' +
      '<td><input class="form-control" type="text" name="lastnameC[]" style="height: 30px;" ></td>' +
      '<td><input class="form-control" type="text" name="publicnameC[]" style="height: 30px;"></td>' +
      '<td><input class="form-control" type="number" name="orcidC[]" style="height: 30px;"></td>' +
      '<td class="align-middle">' +
      '<div class="form-check cAuthor" style="display: inline-block; margin-right: 10px">' +
      '<input class="form-check-input" type="checkbox" name="contributor_type_coauthor[' + index + ']" value="Co-Author">' +
      '<label class="form-check-label"> Co-Author</label>' +
      '</div>' +
      '<div class="form-check pContact" style="display: inline-block">' +
      '<input class="form-check-input" type="checkbox" name="contributor_type_primarycontact[' + index + ']" value="Primary Contact">' +
      '<label class="form-check-label"> Primary Contact</label>' +
      '</div>' +
      '</td>'
      +
      '<td class="align-middle"><input class="form-check-input" type="checkbox" name="selectToDelete"></td>' +
      '</tr>';

  $('#contributorTable tbody').append(newRow);
}

// Attach event listener to the email input field for fetching data on blur
$('#contributorTable tbody').on('blur', 'input.email-input', function() {
  var email = $(this).val();
  var currentRow = $(this).closest('tr');

  if (email !== '') {
    
      $.ajax({
          type: 'POST',
          url: 'fetch_author_data.php', 
          data: { email: email },
          dataType: 'json',
          success: function(response) {
              if (response.success) {
                  // Update the current row with fetched data
                  currentRow.find('input[name="firstnameC[]"]').val(response.data.first_name);
                  currentRow.find('input[name="lastnameC[]"]').val(response.data.last_name);
                  currentRow.find('input[name="publicnameC[]"]').val(response.data.public_name);
                  currentRow.find('input[name="orcidC[]"]').val(response.data.orc_id);
              } else {
                  // Handle the case where the email does not exist in the database
                  Swal.fire({
                  icon: "question",
                  title: "This email is new to us",
                  text: "Please try to input the contributors info manually."
                
                });
              }
          },
          error: function(xhr, status, error) {
              console.error('Error fetching data:', error);
          }
      });
  }
});


function saveData() {
const title = document.getElementById('title');
const abstract = document.getElementById('abstract');
const keywords = document.getElementById('keywords');
const reference = document.getElementById('reference');
const form = document.getElementById('form');

const file_name = document.getElementById('file_name');
const file_name2 = document.getElementById('file_name2');
const file_name3 = document.getElementById('file_name3');

const titlePreview = document.getElementById('input5f1');
const abstractPreview = document.getElementById('input7');
const keywordsPreview = document.getElementById('input6');
const referencePreview = document.getElementById('input8');

const filePreview = document.getElementById('input9');
const filePreview2 = document.getElementById('input9f');
const filePreview3 = document.getElementById('input9g');

const submitBtn = document.getElementById('submit');

if (title.value === '' ||abstract.value === '' || keywords.value === '' || reference.value === '' || file_name.value === '' || file_name2.value === '' || file_name3.value === '' || titlePreview.value === '' || abstractPreview.value === '' || keywordsPreview.value === '' || referencePreview.value === ''|| filePreview.value === '' || filePreview2.value === '' || filePreview3.value === ''  ) {
 
  submitBtn.type = 'button';

  Swal.fire({
    icon: 'warning',
    text: 'Please complete the requested article information'
  });

  return;
} else {
 
  var formData = new FormData(form);

  $('#contributorTable tbody tr').each(function (index, row) {
    var coAuthorCheckbox = $(row).find('input[name="contributor_type_coauthor[]"]');
    var primaryContactCheckbox = $(row).find('input[name="contributor_type_primarycontact[]"]');

    if (coAuthorCheckbox.is(':checked')) {
      formData.append('contributor_type_coauthor[' + index + ']', 'Co-Author');
    }

    if (primaryContactCheckbox.is(':checked')) {
      formData.append('contributor_type_primarycontact[' + index + ']', 'Primary Contact');
    }
  });

  submitBtn.type = 'submit';

  $('#loadingOverlay').show();

  form.submit();
}
}





function deleteData() {
// Iterate through each checkbox
$('input[name="selectToDelete"]:checked').each(function() {
    // Delete the corresponding row
    $(this).closest('tr').remove();
});
}