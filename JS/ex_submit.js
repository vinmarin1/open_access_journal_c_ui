// document.addEventListener('DOMContentLoaded', function () {
//   var tabButtons = document.querySelectorAll('.nav-link');
//   var tabContent = document.querySelectorAll('.tab-pane input');

//   var selectedTabIndex = 0; 

//   for (var i = 1; i < tabButtons.length; i++) {
//     tabButtons[i].disabled = true;
//   }

//   function updateStyles() {
//     tabButtons.forEach(function (btn, i) {
//       if (i === selectedTabIndex) {
//         btn.style.backgroundColor = "#115272";
//         btn.style.color = "white";
//       } else {
//         btn.style.backgroundColor = "white";
//         btn.style.border = "1px solid";
//         btn.style.color = "#115272";
//       }
//     });
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

//       tabButtons.forEach(function (btn, i) {
//         if (i === index) {
//           btn.style.backgroundColor = "#115272";
//           btn.style.color = "white";
//         } else {
//           btn.style.backgroundColor = "white";
//           btn.style.border = "1px solid";
//           btn.style.color = "#115272";
//         }
//       });

//       var currentInput = tabContent[index];
//       if (currentInput.value === '') {
//         return;
//       }

//       if (index < tabButtons.length - 1) {
//         tabButtons[index + 1].disabled = false;
//         tabButtons[index + 1].tab('show');
//       }
//     });

//     // Set initial styles for the first button
//     if (index === 0) {
//       button.style.backgroundColor = "#115272";
//       button.style.color = "white";
//     }
//   });

//   function updateButtonStates(index) {
//     for (var i = index + 1; i < tabButtons.length; i++) {
//       tabButtons[i].disabled = tabContent[i - 1].value === '';
//     }
//   }
// });


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