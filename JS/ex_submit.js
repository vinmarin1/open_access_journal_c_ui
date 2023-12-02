document.addEventListener('DOMContentLoaded', function () {
    var tabButtons = document.querySelectorAll('.nav-link');
    var tabContent = document.querySelectorAll('.tab-pane input');
  
    for (var i = 1; i < tabButtons.length; i++) {
      tabButtons[i].disabled = true;
    }
  
    tabContent.forEach(function (input, index) {
      function updateStyles() {
        if (document.activeElement === input) {
          // If the input is focused, set the focus styles
          tabButtons[index].style.backgroundColor = "#115272";
          tabButtons[index].style.color = "white";
        } else {
          // If the input is not focused, set the blur styles
          tabButtons[index].style.backgroundColor = "white";
          tabButtons[index].style.border = "1px solid";
          tabButtons[index].style.color = "#115272";
        }
      }
  
      input.addEventListener('input', function () {
        updateButtonStates(index);
        updateStyles();
      });
  
      // Add focus event listener to change the background color and text color of the current button
      input.addEventListener('focus', function () {
        updateStyles();
      });
  
      // Add blur event listener to reset the background color and text color when the input loses focus
      input.addEventListener('blur', function () {
        updateStyles();
      });
    });
  
    tabButtons.forEach(function (button, index) {
      button.addEventListener('click', function () {
        // Update styles when clicking on the button
        tabButtons.forEach(function (btn, i) {
          if (i === index) {
            btn.style.backgroundColor = "#115272";
            btn.style.color = "white";
          } else {
            btn.style.backgroundColor = "white";
            btn.style.border = "1px solid";
            btn.style.color = "#115272";
          }
        });
  
        var currentInput = tabContent[index];
        if (currentInput.value === '') {
          return;
        }
  
        if (index < tabButtons.length - 1) {
          tabButtons[index + 1].disabled = false;
          tabButtons[index + 1].tab('show');
        }
      });
  
      // Set initial styles for the first button
      if (index === 0) {
        button.style.backgroundColor = "#115272";
        button.style.color = "white";
      }
    });
  
    function updateButtonStates(index) {
      for (var i = index + 1; i < tabButtons.length; i++) {
        tabButtons[i].disabled = tabContent[i - 1].value === '';
      }
    }
  });


  var quill = new Quill('#editor', {
    theme: 'snow'
  });
  var quill = new Quill('#editor2', {
    theme: 'snow'
  });
  


  