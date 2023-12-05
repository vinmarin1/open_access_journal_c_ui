document.addEventListener('DOMContentLoaded', function () {
  var tabButtons = document.querySelectorAll('.nav-link');
  var tabContent = document.querySelectorAll('.tab-pane input');

  var selectedTabIndex = 0;

  for (var i = 1; i < tabButtons.length; i++) {
    tabButtons[i].disabled = true;
  }

  // Get references to the buttons
  var prevBtn = document.getElementById("prev");
  var nextBtn = document.getElementById("next");
  var submitBtn = document.getElementById("submit");

  function updateButtonVisibility(index) {
    // Display buttons based on the current tab index
    if (index === 0) {
      prevBtn.style.display = "none";
      nextBtn.style.display = "inline-block";
      submitBtn.style.display = "none";
    } else if (index > 0 && index < tabButtons.length - 1) {
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
        btn.style.backgroundColor = "#115272";
        btn.style.color = "white";
      } else {
        btn.style.backgroundColor = "white";
        btn.style.border = "1px solid";
        btn.style.color = "#115272";
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
      var currentInput = tabContent[selectedTabIndex];
      if (currentInput.value === '' || tabButtons[selectedTabIndex + 1].disabled) {
        return; // Do nothing if the input field is empty or the next button is disabled
      }

      tabButtons[selectedTabIndex + 1].click(); // Simulate a click on the next tab button
    }
  }

  function switchToPrevTab() {
    if (selectedTabIndex > 0) {
      tabButtons[selectedTabIndex - 1].click(); // Simulate a click on the previous tab button
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
      button.style.backgroundColor = "#115272";
      button.style.color = "white";
      updateButtonVisibility(index);
    }
  });

  nextBtn.addEventListener('click', switchToNextTab);
  prevBtn.addEventListener('click', switchToPrevTab);
});


  var quill = new Quill('#editor', {
    theme: 'snow'
  });
  var quill = new Quill('#editor2', {
    theme: 'snow'
  });
  var quill = new Quill('#editor3', {
    theme: 'snow'
  });


  


  document.getElementById('file_name').addEventListener('change', function () {
  var selectedFiles = this.files;
  var fileList = document.getElementById('fileList');

  for (var i = 0; i < selectedFiles.length; i++) {
    var fileRow = fileList.insertRow(fileList.rows.length);
    var fileNameCell = fileRow.insertCell(0);
    fileNameCell.textContent = selectedFiles[i].name;

    var fileTypeCell = fileRow.insertCell(1);
    fileTypeCell.textContent = selectedFiles[i].type;

    var actionCell = fileRow.insertCell(2);
    var deleteButton = document.createElement('button');
    deleteButton.type = 'button';
    deleteButton.className = 'btn btn-danger btn-sm';
    deleteButton.textContent = 'Delete';
    deleteButton.setAttribute('data-row-index', fileRow.rowIndex);
    deleteButton.onclick = deleteFile;
    actionCell.appendChild(deleteButton);
  }
});


function openFileModal() {
  document.getElementById('file_name').click();
}

function deleteFile(rowIndex) {
  var fileList = document.getElementById('fileList');


  if (rowIndex >= 0 && rowIndex < fileList.rows.length) {
    fileList.deleteRow(rowIndex);
  }
}

document.getElementById('file_name').addEventListener('change', function (event) {
  var fileList = document.getElementById('fileList');


  while (fileList.firstChild) {
    fileList.removeChild(fileList.firstChild);
  }

  for (var i = 0; i < this.files.length; i++) {
    var file = this.files[i];

    var newRow = fileList.insertRow(i);

    newRow.insertCell(0).innerHTML = file.name;
    newRow.insertCell(1).innerHTML = file.type;

  
    var deleteButton = document.createElement('button');
    deleteButton.innerHTML = 'Delete';
    deleteButton.className = 'btn btn-danger btn-sm';
    deleteButton.addEventListener('click', function () {
      // Get the row index of the clicked delete button
      var rowIndex = this.parentElement.parentElement.rowIndex;
      deleteFile(rowIndex - 1);e 
    });

    newRow.insertCell(2).appendChild(deleteButton);
  }
});


document.getElementById('contributor-btn').addEventListener('click', function (event) {
  Swal.fire({
    html:
      '<h5 class="title9" id="title-9">Contributors</h5>' +
      '<hr id="swal-d">' +
      '<div id="fName"><label id="sub-16">First Name: </label><input id="input1" class="swal2-input"></div>' +
      '<div id= "lName"><label id="sub-17">Last Name: </label><input id="input2" class="swal2-input"></div>' +
      '<label id= "sub-18">Preferred Public Name: </label><input id="input3" class="swal2-input">' +
      '<label id= "sub-19">Email: </label><input id="input4" class="swal2-input">' +
      '<label id= "sub-20">ORCID: </label><input id="input5" class="swal2-input">',

    footer: '<button  id="confirmBtn">Add Contributor</button>',
    showConfirmButton: false,
  });

  document.getElementById('confirmBtn').addEventListener('click', function () {
  
    var input1Value = document.getElementById('input1').value;
    var input2Value = document.getElementById('input2').value;

    var contributorsValue = input1Value + ' ' + input2Value;


    var table = document.getElementById('table-contributor').getElementsByTagName('tbody')[0];
    var newRow = table.insertRow(table.rows.length);

    var cellContributor = newRow.insertCell(0);
    cellContributor.innerHTML = contributorsValue;

    var cellActions = newRow.insertCell(1);
    cellActions.innerHTML = '<button id="btn-update" class="btn btn-outline-primary btn-sm btn-update" style="margin-right: 10px;">Update</button>' +
                            '<button id="btn-delete" class="btn btn-danger btn-sm btn-delete">Delete</button>';

 
    // var updateBtn = cellActions.querySelector('.btn-update');
    var deleteBtn = cellActions.querySelector('.btn-delete');

    deleteBtn.addEventListener('click', function () {
    
      var rowIndex = this.closest('tr').rowIndex;
    
      table.deleteRow(rowIndex - 1); 
    
      console.log(contributorsValue);
    });

   
    Swal.close();
  });
});


// function (){

// }
