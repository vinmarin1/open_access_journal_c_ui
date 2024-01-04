document.addEventListener('DOMContentLoaded', function () {
  var tabButtons = document.querySelectorAll('.nav-link');
  var tabContent = document.querySelectorAll('.tab-pane input');
  var selectedTabIndex = 0;
  var prevBtn = document.getElementById("prev");
  var nextBtn = document.getElementById("next");
  var submitBtn = document.getElementById("submit");
  var form = document.getElementById("form");
  var inputFields = form.querySelectorAll("input");


  for (var i = 1; i < tabButtons.length; i++) {
    tabButtons[i].disabled = true;
  }



  function updateButtonVisibility(index) {
    // Display buttons based on the current tab index
    if (index === 0) {
      prevBtn.style.display = "none";
      nextBtn.style.display = "inline-block";
      submitBtn.style.display = "none";
  
    }else if(index === 1){
      prevBtn.style.display = "inline-block";
      nextBtn.disabled = true;
      submitBtn.style.display = "none";

 
    } 
    else if (index > 0 && index < tabButtons.length - 1) {
      prevBtn.style.display = "inline-block";
      nextBtn.style.display = "inline-block";
      submitBtn.style.display = "none";
  
    } else if (index === tabButtons.length - 1) {
      prevBtn.style.display = "inline-block";
      nextBtn.style.display = "none";
      submitBtn.style.display = "inline-block";
  
    }
  }

  function updateStyles() {
    tabButtons.forEach(function (btn, i) {
      if (i === selectedTabIndex) {
        btn.style.backgroundColor = "#0858a4";
        btn.style.color = "white";
        btn.style.border = "none";
      } else {
        btn.style.backgroundColor = "white";
        btn.style.border = "none";
        btn.style.color = "#0858a4";
      }
    });
  }

  function updateButtonStates(index) {
    for (var i = index + 1; i < tabButtons.length; i++) {
      tabButtons[i].disabled = tabContent[i - 1].value === '';
    }
  }

  function switchToNextTab() {
    if (selectedTabIndex < tabButtons.length - 1) {
      inputFields = tabContent[selectedTabIndex];
      if (inputFields.value === '' || tabButtons[selectedTabIndex + 1].disabled) {
     
        Swal.fire({
          html: '<h4 style="color: #0858a4; font-family: font-family: Arial, Helvetica, sans-serif">Please read and check the guidelines to proceed</4>',
          icon: 'warning',
        })
      }

      tabButtons[selectedTabIndex + 1].click(); // Simulate a click on the next tab button
      
    }
  }

  function switchToPrevTab() {
    if (selectedTabIndex > 0) {
      tabButtons[selectedTabIndex - 1].click(); // Simulate a click on the previous tab button
      nextBtn.disabled = false;
    }
  }

  tabContent.forEach(function (input, index) {
    input.addEventListener('input', function () {
      updateButtonStates(index);
      updateStyles();
    });

    input.addEventListener('focus', function () {
      updateStyles();
    });

    input.addEventListener('blur', function () {
      // Don't change styles on blur
    });
  });

  tabButtons.forEach(function (button, index) {
    button.addEventListener('click', function () {
      selectedTabIndex = index;
      updateButtonVisibility(index);
      updateButtonStates(index);
      updateStyles();
    });

    // Set initial styles and button visibility for the first button
    if (index === 0) {
      button.style.backgroundColor = "#0858a4";
      button.style.color = "white";
      updateButtonVisibility(index);
    }

  
    
  });




  nextBtn.addEventListener('click', switchToNextTab);
  prevBtn.addEventListener('click', switchToPrevTab);

  

  
  
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

  titleInput.addEventListener('input', function () {
      const wordCount = titleInput.value.trim().split(/\s+/).length;

      if (wordCount < 10 || wordCount > 20) {
          titleValidation.style.display = 'block';
      } else {
          titleValidation.style.display = 'none';
      }

      checkValidations();
  });

  editor.addEventListener('input', function () {
      const wordCount = editor.value.trim().split(/\s+/).length;

      if (wordCount < 50 || wordCount > 600) {
          abstractValidation.style.display = 'block';
      } else {
          abstractValidation.style.display = 'none';
      }

      checkValidations();
  });

  keywords.addEventListener('input', function () {
      const commaCount = (keywords.value.match(/,/g) || []).length;

      if (commaCount < 1 || commaCount > 4) {
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

  input.addEventListener('change', function() {
    var fileName = input.files[0].name;
   
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
    
    '<p class="h6" id="referenceAbstractlabel">Abstract:</p> ' + 
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
          '<p class="h6 mt-5" id="updatePreviewFile1">File With Author: </p>' +
          '<input type="text" class="form-control" id="file1UpdatePreview"  value="' + input9 +'">' + '<button type="button" class="btn btn-primary btn-sm" id="btnSelectFile1" onclick="openFilename(1)">Select File</button>' + 
          '<p class="h6" id="updatePreviewFile2">File With no Author: </p>' +
          '<input type="text" class="form-control" id="file2UpdatePreview" value="' + input9f +'">' +
          '<button type="button" class="btn btn-primary btn-sm" id="btnSelectFile2" onclick="openFilename(2)">Select File</button>' +
          '<p class="h6" id="updatePreviewFile3">Title Page: </p>' +
          '<input type="text" class="form-control" id="file3UpdatePreview" value="' + input9g +'">' +
          '<button type="button" class="btn btn-primary btn-sm" id="btnSelectFile2" onclick="openFilename(3)">Select File</button><br>' +
          '<button type="button"  class="btn btn-secondary btn-sm mt-4" id="btnClose" >Close</button> ' +
          '</div>',
    showConfirmButton: false,
  });

  document.getElementById('btnClose').addEventListener('click', function(event) {

    

    Swal.close();

  });



});



