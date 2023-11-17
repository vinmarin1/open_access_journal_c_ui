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
      // Set the value to "1" for the selected radio button
      this.value = "1";

      // Remove the value attribute from the other radio buttons
      for (var j = 0; j < radioSelect.length; j++) {
        if (radioSelect[j] !== this) {
          radioSelect[j].removeAttribute('value');
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
  var selectedFile = this.files[0];

  var fileNameElement = document.querySelector('.fileName');
  if (fileNameElement) {
    fileNameElement.textContent = selectedFile ? selectedFile.name : '';
  }

  var fileTypeElement = document.querySelector('.fileType');
  if (fileTypeElement) {
    fileTypeElement.textContent = selectedFile ? selectedFile.type : '';
  }
});

function openFileModal() {
  document.getElementById('hiddenFileInput').click();
}


window.deleteFile = function() {
  var fileNameElement = document.querySelector('.fileName');
  if (fileNameElement) {
    fileNameElement.textContent = '';
  }

  var fileTypeElement = document.querySelector('.fileType');
  if (fileTypeElement) {
    fileTypeElement.textContent = '';
  }
};




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
      const contributorCell = document.querySelector('.table tbody .contributorName');
      contributorCell.textContent = result.value.contributorName;
    }
  });
});


window.deleteC = function() {
  var fileNameElement = document.querySelector('.contributorName');
  if (fileNameElement) {
    fileNameElement.textContent = '';
  }

};