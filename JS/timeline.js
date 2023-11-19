var currentTab = 0; 
showTab(currentTab); 

function showTab(n) {

  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";

  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }

  fixStepIndicator(n)
}

function nextPrev(n) {

  var x = document.getElementsByClassName("tab");

  if (n == 1 && !validateForm()) return false;

  x[currentTab].style.display = "none";

  currentTab = currentTab + n;
 
  if (currentTab >= x.length) {
 
    document.getElementById("multiSForm").submit();
    return false;
  }

  showTab(currentTab);
}

var checkbox = document.getElementById('flexCheckIndeterminate');

checkbox.addEventListener('change', function(){
  if(checkbox.checked){
    checkbox.value = "1";
  }else{
    checkbox.value = "";
  }
})


var radioSelect = document.getElementsByClassName('radio-select');

for (var i = 0; i < radioSelect.length; i++) {
  radioSelect[i].addEventListener('change', function() {
    if (this.checked) {
     
      var selectedIndex = Array.from(radioSelect).indexOf(this) + 1;
      this.value = selectedIndex.toString();

      for (var j = 0; j < radioSelect.length; j++) {
        if (radioSelect[j] !== this) {
        
          radioSelect[j].value = "0";
        }
      }
    }
  });
}


function makeTextareaRequired() {
  var abstractTextarea = document.getElementById('abstract');

  if (abstractTextarea) {
    abstractTextarea.setAttribute('required', 'required');
  }
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

  x[n].className += " active";
}




document.getElementById('hiddenFileInput').addEventListener('change', function () {
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
  document.getElementById('hiddenFileInput').click();
}

function deleteFile(rowIndex) {
  var fileList = document.getElementById('fileList');


  if (rowIndex >= 0 && rowIndex < fileList.rows.length) {
    fileList.deleteRow(rowIndex);
  }
}

document.getElementById('hiddenFileInput').addEventListener('change', function (event) {
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



document.getElementById('contributor-btn').addEventListener('click', function () {
  Swal.fire({
    title: "Add Contributor",
    input: "text",
    inputAttributes: {
      autocapitalize: "off"
    },
    showCancelButton: true,
    confirmButtonText: "Add",
    showLoaderOnConfirm: true,
    preConfirm: async (contributorName) => {
      try {
        return { contributorName };
      } catch (error) {
        Swal.showValidationMessage(`Request failed: ${error}`);
      }
    },
    allowOutsideClick: () => !Swal.isLoading()
  }).then((result) => {
    if (result.isConfirmed) {
      const contributorsTableBody = document.getElementById('contributors-table-body');

      const newRow = document.createElement('tr');
  
      const nameCell = document.createElement('td');
      nameCell.textContent = result.value.contributorName;
      newRow.appendChild(nameCell);
 
      const deleteCell = document.createElement('td');
      const deleteButton = document.createElement('button');
      deleteButton.type = 'button';
      deleteButton.className = 'btn btn-danger btn-sm';
      deleteButton.textContent = 'Delete';
      deleteButton.addEventListener('click', function() {
        contributorsTableBody.removeChild(newRow);
      });
      deleteCell.appendChild(deleteButton);
      newRow.appendChild(deleteCell);
      
      contributorsTableBody.appendChild(newRow);
    }
  });
});









// INSERTING DATA




