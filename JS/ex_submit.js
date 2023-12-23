document.addEventListener('DOMContentLoaded', function () {
  var tabButtons = document.querySelectorAll('.nav-link');
  var tabContent = document.querySelectorAll('.tab-pane input');
  var selectedTabIndex = 0;
  var prevBtn = document.getElementById("prev");
  var nextBtn = document.getElementById("next");
  var submitBtn = document.getElementById("submit");
  var form = document.getElementById("form");
  var inputFields = form.querySelectorAll("input");
  var title = document.getElementById('title');
  var keywords = document.getElementById('keywords');
  var abstract = document.getElementById('abstract');
  var reference = document.getElementById('reference');

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


document.getElementById('form').addEventListener('submit', function (event) {
  const check = document.getElementById('check').value;
  const title = document.getElementById('title').value;
  const abstract = document.getElementById('abstract').value;
  const keyword = document.getElementById('keyword').value;
  const reference = document.getElementById('reference').value;
  const notes = document.getElementById('notes').value;
  const file_name = document.getElementById('file_name').value;

  if (!check || !title || !abstract || !keyword || !reference || !notes || !file_name) {
    event.preventDefault();
    alert("Please fill in all the required fields.");
  }
});




var quill1 = new Quill('#editor', {
  theme: 'snow'
});

var quill2 = new Quill('#editor2', {
  theme: 'snow'
});

var titleInput = document.getElementById("title");
var keywordsInput = document.getElementById("keywords");
var abstractInput = document.getElementById('abstract');
var referenceInput = document.getElementById('reference');

const titleInputValidation = document.getElementById('title');
const titleValidation = document.getElementById('title-validation');

const keywordsInputValidation = document.getElementById('keywords');
const keywordsValidation = document.getElementById('keywords-validation');

const abstractInputValidation = document.getElementById('abstract');
const abstractValidation = document.getElementById('abstract-validation');

quill1.on('text-change', function() {
  abstractInput.value = quill1.getText();
  updateButtonState();
});

quill2.on('text-change', function() {
  referenceInput.value = quill2.getText();
  updateButtonState();
});

titleInput.addEventListener('input', function () {
  inputValidation(titleInput, titleValidation, function (value) {
    const wordCount = value.split(/\s+/).length;
    return wordCount >= 10 && wordCount <= 20;
  });
  updateButtonState();
});

keywordsInput.addEventListener('input', function () {
  inputValidation(keywordsInput, keywordsValidation, function (value) {
    const commaCount = (value.match(/,/g) || []).length;
    return commaCount >= 1 && commaCount <= 4;
  });
  updateButtonState();
});

abstractInput.addEventListener('input', function () {
  inputValidation(abstractInput, abstractValidation, function (value) {
    const wordCount = value.split(/\s+/).length;
    return wordCount < 10;
  });
  updateButtonState();
});

// Periodically check if abstractInput and referenceInput have values
setInterval(function() {
  updateButtonState();
}, 1000); // Adjust the interval as needed

function updateButtonState() {
  const formFloat = document.getElementById('form-floating-2');
  const formFloating = document.getElementById('form-floating');
  const formFloating3 = document.getElementById('form-floating-3');
  const qlToolbar = document.getElementsByClassName('ql-toolbar');
  const isTitleValid = titleValidation.style.display === 'none';
  const isKeywordsValid = keywordsValidation.style.display === 'none';
  const isAbstractValid = abstractValidation.style.display === 'none';

  if (
    titleInput.value.trim() !== '' &&
    keywordsInput.value.trim() !== '' &&
    abstractInput.value.trim() !== '' &&
    referenceInput.value.trim() !== '' &&
    isTitleValid &&
    isKeywordsValid &&
    isAbstractValid
  ) {
    formFloating.style.width = '60%';
    formFloating3.style.width = '60%';
    formFloat.style.display = 'inline-block';
  } else {
    formFloat.style.display = 'none';
  }

  
}


function inputValidation(inputElement, validationElement, conditionFunction) {
  const inputValue = inputElement.value.trim();
  const isValid = conditionFunction(inputValue);
  if (isValid) {
    validationElement.style.display = 'none';
  } else {
    validationElement.style.display = 'block';
  }
}


  var quill3 = new Quill('#editor3', {
    theme: 'snow'
  });

 

  quill3.on('text-change', function() {
    notes.value = quill3.getText();
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




document.getElementById('contributor-btn').addEventListener('click', function (event) {
  Swal.fire({
    html:
      '<h5 class="title9" id="title-9">Contributors</h5>' +
      '<hr id="swal-d">' +
      '<div id="fName"><label id="sub-16">First Name: </label><input id="input1" class="swal2-input"></div>' +
      '<div id= "lName"><label id="sub-17">Last Name: </label><input id="input2" class="swal2-input"></div>' +
      '<label id= "sub-18">Preferred Public Name: </label><input id="input3" class="swal2-input">' +
      '<label id= "sub-19">Email: </label><input id="input4" class="swal2-input">' +
      '<label id= "sub-20">ORCID: </label><input id="input5" class="swal2-input">'+ '<label id="selectRoleLabel">Role: </label><select class="form-select" name="selectRole" id="selectRole"><option value="">Select Role</option><option value="Contact Principal">Contact Principal</option><option value="Co-Author">Co-Author</option></select> ',

    footer: '<button  id="confirmBtn">Add Contributor</button>',
    showConfirmButton: false,
  });

 


  

  document.getElementById('confirmBtn').addEventListener('click', function () {
  
    var input1Value = document.getElementById('input1').value;
    var input2Value = document.getElementById('input2').value;
    var input3Value = document.getElementById('input3').value;
    var input4Value = document.getElementById('input4').value;
    var input5Value = document.getElementById('input5').value;

    var contributorsValue = input1Value + ' ' + input2Value;


    var table = document.getElementById('table-contributor').getElementsByTagName('tbody')[0];
    var newRow = table.insertRow(table.rows.length);

    var cellContributor = newRow.insertCell(0);
    cellContributor.innerHTML = contributorsValue;

    var cellActions = newRow.insertCell(1);
    cellActions.innerHTML = '<button type="button" id="btn-update" class="btn btn-outline-primary btn-sm btn-update" style="margin-right: 10px;">View</button>' +
    '<button type="button" id="btn-delete" class="btn btn-danger btn-sm btn-delete">Delete</button>';

 
    var updateBtn = cellActions.querySelector('.btn-update');
    var deleteBtn = cellActions.querySelector('.btn-delete');

    let updatedInput1Value;
    let updatedInput2Value;
    let updatedInput3Value;
    let updatedInput4Value;
    let updatedInput5Value;
    
    updateBtn.addEventListener('click', function (event) {
        Swal.fire({
            html: '<h5 class="title10" id="title-10">Update Contributor</h5>' +
                '<hr id="swal-d">' +
                '<div id="fName"><label id="sub-21">First Name: </label><input id="updateInput1" class="swal2-input" value="' + (updatedInput1Value || input1Value) + '"></div>' +
                '<div id= "lName"><label id="sub-22">Last Name: </label><input id="updateInput2" class="swal2-input" value="' + (updatedInput2Value || input2Value) + '"></div>' +
                '<label id= "sub-23">Preferred Public Name: </label><input id="updateInput3" value="' + (updatedInput3Value || input3Value) + '" class="swal2-input">' +
                '<label id= "sub-24">Email: </label><input id="updateInput4" value="' + (updatedInput4Value || input4Value) + '" class="swal2-input">' +
                '<label id= "sub-25">ORCID: </label><input id="updateInput5" value="' + (updatedInput5Value || input5Value) + '" class="swal2-input">'+ '<label id="selectRoleLabelUpdate">Role: </label><select class="form-select" name="selectRoleUpdate" id="selectRoleUpdate"><option value="">Select Role</option><option value="Contact Principal">Contact Principal</option><option value="Co-Author">Co-Author</option></select> ',
    
            footer: '<button id="update-cont">Update</button>',
            showConfirmButton: false
        });
    
        document.getElementById('update-cont').addEventListener('click', function () {
            var updatedInput1Element = document.getElementById('updateInput1');
            var updatedInput2Element = document.getElementById('updateInput2');
            var updatedInput3Element = document.getElementById('updateInput3');
            var updatedInput4Element = document.getElementById('updateInput4');
            var updatedInput5Element = document.getElementById('updateInput5');
    
            updatedInput1Value = updatedInput1Element.value;
            updatedInput2Value = updatedInput2Element.value;
            updatedInput3Value = updatedInput3Element.value;
            updatedInput4Value = updatedInput4Element.value;
            updatedInput5Value = updatedInput5Element.value;
    
            contributorsValue = updatedInput1Value + ' ' + updatedInput2Value;
            cellContributor.innerHTML = contributorsValue;
    
            Swal.close();
        });
    });
    
    
    deleteBtn.addEventListener('click', function () {
    
      var rowIndex = this.closest('tr').rowIndex;
    
      table.deleteRow(rowIndex - 1); 
    
      console.log(contributorsValue);
    });

   
    Swal.close();
  });


  
});


var titleInput = document.getElementById("title");
var keywordsInput = document.getElementById("keywords")
var fileInput = document.getElementById("file_name");
var fileInputf = document.getElementById("file_name2");
var fileInputg = document.getElementById("file_name3");
var contributorInput = document.getElementById("contributor").textContent;



var input5 = document.getElementById("input5f1");
var input6 = document.getElementById("input6");
var input7 = document.getElementById("input7");
var input8 = document.getElementById("input8");
var input9 = document.getElementById("input9");
var input9f = document.getElementById("input9f");
var input9g = document.getElementById("input9g");
var input10 = document.getElementById("input10");
var input11 = document.getElementById("input11");
var input12 = document.getElementById("input12");
var input13 = document.getElementById("input13");
var input14 = document.getElementById("input14");
var input15 = document.getElementById("input15");
var input15f = document.getElementById("input15f");
var input15g = document.getElementById("input15g");


titleInput.addEventListener('input', function() {
  input5.value = titleInput.value;
  input11.value = titleInput.value;
});

keywordsInput.addEventListener('input', function() {
  input6.value = keywordsInput.value;
  input12.value = titleInput.value;
});

quill1.on('text-change', function() {
  input7.value = quill1.getText();
  input13.value = quill1.getText();
});
quill2.on('text-change', function() {
  input8.value = quill2.getText();
  input14.value = quill2.getText();
});

fileInput.addEventListener('input', function() {

  if (fileInput.files.length > 0) {
    
    input9.value = fileInput.files[0].name;
   
    
  } else {
   
    input9.value = "";
   
  }
});

fileInputf.addEventListener('input', function() {

  if (fileInputf.files.length > 0) {
    
    input9f.value = fileInputf.files[0].name;
   
    
  } else {
   
    input9f.value = "";
   
  }
});
fileInputg.addEventListener('input', function() {

  if (fileInputg.files.length > 0) {
    
    input9g.value = fileInputg.files[0].name;
   
    
  } else {
   
    input9g.value = "";
   
  }
});


input10.value = contributorInput;












document.getElementById('update-cont-2').addEventListener('click', function (event) {



  Swal.fire({
    html: '<h5 class="title14" id="title-14">Update Article Details</h5>' + '<hr id="swal-d-2">' + '<label class="sub30" id="sub-30">Title: <input type="text" class="form-control" id="input11" value="'+ titleInput.value +'"></label>' +  '<label class="sub31" id="sub-31">Keywords: <input type="text" class="form-control" id="input12" value="'+ keywordsInput.value +'"></label>'  + '<label class="sub32" id="sub-32">Abstract: <input type="text" class="form-control" id="input13" id="input12" value="'+ quill1.getText() +'"></label>' +  '<label class="sub33" id="sub-33">Reference: <input type="text" class="form-control" id="input14" value="'+ quill2.getText() +'"></label>',
    footer: '<button  id="btn-article-update">Update</button>',
    showConfirmButton: false,
  });

  document.getElementById('btn-article-update').addEventListener('click', function () {
    var newTitle = document.getElementById('input11').value;
    var newKeywords = document.getElementById('input12').value;
    var newAbstract = document.getElementById('input13').value;
    var newReference = document.getElementById('input14').value;

  
    titleInput.value = newTitle;
    keywordsInput.value = newKeywords;
  
    input5.value = newTitle;
    input6.value = newKeywords;
    input7.value = newAbstract;
    input8.value = newReference;
  
    try {
      quill1.setText(newAbstract);
     
    } catch (error) {
      console.error("Unable to update Abstract Content:", error);
      
    }

    // i add two separate try catch because its not working when putting them in one :>>>
    
    try {
      quill2.setText(newReference);
     
    } catch (error) {
      console.error("Unable to update Reference Content:", error);
      
    }
    
    
  
    Swal.close();
  });
  

 
});
document.getElementById('update-cont-3').addEventListener('click', function (event) {
  
  Swal.fire({
    html: '<h5 class="title15" id="title-15">Update File Content</h5>' +  '<hr id="swal-d-3">' 
    + '<label id="sub-34">File Name: </label>'
    + '<input type="text" class="form-control" id="input15" style="width: 70%; display:inline-block" accept=".docx" readonly></input>' + 
    '<button type="button" class="btn btn-primary btn-sm" id="newFile">Select File</button> ' + '<input type="text" class="form-control" id="input15f" style="width: 70%; display:inline-block" accept=".docx" readonly></input>' + 
    '<button type="button" class="btn btn-primary btn-sm" id="newFilef">Select File</button> '+ '<input type="text" class="form-control" id="input15g" accept=".docx" style="width: 70%; display:inline-block" readonly></input>' + 
    '<button type="button" class="btn btn-primary btn-sm" id="newFileg">Select File</button> ',
    showConfirmButton: false
    
  })


  document.getElementById('newFile').addEventListener('click', function() {
    document.getElementById('file_name').click();
  });

  document.getElementById('file_name').addEventListener('change', function () {
    var fileName = this.files[0].name;
    document.getElementById('input15').value = fileName;
});

document.getElementById('newFilef').addEventListener('click', function() {
  document.getElementById('file_name2').click();
});

document.getElementById('file_name2').addEventListener('change', function () {
  var fileNamef = this.files[0].name;
  document.getElementById('input15f').value = fileNamef;
});


document.getElementById('newFileg').addEventListener('click', function() {
  document.getElementById('file_name3').click();
});

document.getElementById('file_name3').addEventListener('change', function () {
  var fileNameg = this.files[0].name;
  document.getElementById('input15g').value = fileNameg;
});



});


function inputValidation(inputElement, validationElement, conditionFunction) {
  inputElement.addEventListener('blur', function () {
      const inputValue = inputElement.value.trim();
      const isValid = conditionFunction(inputValue);
      if (isValid) {
          validationElement.style.display = 'none';
      } else {
          validationElement.style.display = 'block';
      }
  });
}